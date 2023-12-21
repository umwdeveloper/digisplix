<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Support;
use App\Models\SupportReply;
use App\Models\User;
use App\Notifications\SupportCreated;
use App\Notifications\SupportReplied;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class SupportController extends Controller {
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $tickets = Support::with('user')->where('user_id', Auth::user()->id)->orderByDesc('updated_at')->get();

        return view('clients.support.index', [
            'tickets' => $tickets,
            'statuses' => Support::getStatuses(),
            'status_labels' => Support::getStatusLabels(),
            'status_colors' => Support::getStatusColors(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {
        return view('clients.support.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
        $ticket = Support::create([
            'user_id' => Auth::user()->id,
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'department' => $request->input('department'),
        ]);

        Notification::send(User::getAdmin(), new SupportCreated($ticket->id));

        return response()->json([
            'status' => 'success',
            'ticket' => $ticket
        ]);
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

        $this->authorize('client.support', $ticket);

        return view('clients.support.show', [
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

        $this->authorize('client.support', $ticket);

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

            $ticket = Support::findOrFail($request->input('ticketID'));
            $ticket->attachments()->create([
                'attachment' => $attachment
            ]);
        }
        return response()->json(['status' => 'success']);
    }

    public function uploadAttachmentReply(Request $request) {
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

        $this->authorize('client.support', $ticket);

        $ticket->status = Support::USER_REPLIED;
        $ticket->save();

        $reply = SupportReply::create([
            'support_id' => $request->input('support_id'),
            'user_id' => $request->input('user_id'),
            'reply' => $request->input('reply'),
        ]);

        Notification::send(User::getAdmin(), new SupportReplied($ticket->subject, $ticket->id));

        return response()->json([
            'status' => 'success',
            'reply' => $reply
        ]);
    }

    public function updateStatus(Request $request, string $id) {
        $ticket = Support::findOrFail($id);

        $this->authorize('client.support', $ticket);

        $ticket->status = $request->input('status');
        $ticket->update();

        return redirect()->back()->with('status', 'Ticket status updated successfully!');
    }
}
