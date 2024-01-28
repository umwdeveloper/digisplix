<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportReply;
use App\Notifications\SupportUpdate;
use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $this->authorize('staff.support');

        $tickets = Support::with(['user', 'user.userable'])->get();
        $statusCounts = Support::groupBy('status')
            ->select('status', DB::raw('count(*) as count'))
            ->get();

        $priorityCounts = Support::groupBy('priority')
            ->select('priority', DB::raw('count(*) as priority_count'))
            ->get();

        return view('staff.support.index', [
            'tickets' => $tickets,
            'completed_tickets' => $tickets->where('status', Support::CLOSED),
            'awaiting_tickets' => $tickets->where('status', Support::AWAITING_USER_RESPONSE),
            'replied_tickets' => $tickets->where('status', Support::USER_REPLIED),
            'statuses' => Support::getStatuses(),
            'status_labels' => Support::getStatusLabels(),
            'status_colors' => Support::getStatusColors(),
            'status_counts' => $statusCounts,
            'priority_counts' => $priorityCounts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) {
        $this->authorize('staff.support');

        $ticket = Support::with([
            'user',
            'replies',
            'replies.user',
            'attachments',
            'replies.attachments'
        ])->findOrFail($id);

        return view('staff.support.show', [
            'ticket' => $ticket,
            'status_labels' => Support::getStatusLabels(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id) {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) {
        $this->authorize('staff.support');

        $ticket = Support::with([
            'attachments',
            'replies.attachments'
        ])->findOrFail($id);

        $this->deleteAttachments($ticket->replies->pluck('attachments')->flatten());
        $this->deleteAttachments($ticket->attachments);

        $notificationTypeIds = $ticket->notificationTypes()->pluck('notification_id');

        DB::transaction(function () use ($ticket, $notificationTypeIds) {
            $ticket->notificationTypes()->delete();

            DatabaseNotification::whereIn('id', $notificationTypeIds)->delete();
        });

        $ticket->delete();

        return redirect()->back()->with('status', 'Ticket deleted successfully!');
    }

    private function deleteAttachments($attachments) {
        if ($attachments->count() > 0) {
            foreach ($attachments as $attachment) {
                Storage::disk('public')->delete($attachment->attachment);

                $attachment->delete();
            }
        }
    }

    public function uploadAttachment(Request $request) {
        if ($request->hasFile('file')) {
            $attachment = $request->file('file')->store('attachments');

            $reply = SupportReply::findOrFail($request->input('replyID'));
            $reply->attachments()->create([
                'attachment' => $attachment
            ]);
        }
        return response()->json(['status' => 'success']);
    }

    public function storeReply(Request $request) {
        $this->authorize('staff.support');

        $ticket = Support::findOrFail($request->input('support_id'));
        $ticket->status = Support::AWAITING_USER_RESPONSE;
        $ticket->save();

        $reply = SupportReply::create([
            'support_id' => $request->input('support_id'),
            'user_id' => $request->input('user_id'),
            'reply' => $request->input('reply'),
        ]);

        Notification::send($ticket->user, new SupportUpdate($ticket->id, $ticket->subject));

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }

    public function updateStatus(Request $request, string $id) {
        $this->authorize('staff.support');

        $ticket = Support::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->update();

        return redirect()->back()->with('status', 'Ticket status updated successfully!');
    }
}
