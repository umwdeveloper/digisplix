<?php

namespace App\Notifications;

use App\Models\Support;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportReplied extends Notification implements ShouldQueue {
    use Queueable;

    public $subject, $ticket_id, $nid, $nType;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($subject, $ticket_id, $notification_to) {
        $this->subject = $subject;
        $this->ticket_id = $ticket_id;
        $this->nid = $ticket_id;
        $this->nType = Support::class;
        $this->notification_to = $notification_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "Client replied to " . $this->subject,
            "link" => route('staff.support.show', $this->ticket_id)
        ];
    }
}
