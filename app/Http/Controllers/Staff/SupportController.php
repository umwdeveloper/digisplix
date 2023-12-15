<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tickets = Support::with('user')->get();
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
        $ticket = Support::with([
            'attachments',
            'replies.attachments'
        ])->findOrFail($id);

        $this->deleteAttachments($ticket->replies->pluck('attachments')->flatten());
        $this->deleteAttachments($ticket->attachments);

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
        $ticket = Support::findOrFail($request->input('support_id'));
        $ticket->status = Support::AWAITING_USER_RESPONSE;
        $ticket->save();

        $reply = SupportReply::create([
            'support_id' => $request->input('support_id'),
            'user_id' => $request->input('user_id'),
            'reply' => $request->input('reply'),
        ]);

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }

    public function updateStatus(Request $request, string $id) {
        $ticket = Support::findOrFail($id);
        $ticket->status = $request->input('status');
        $ticket->update();

        return redirect()->back()->with('status', 'Ticket status updated successfully!');
    }
}
