<?php

namespace App\Notifications;

use App\Models\Support;
use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SupportUpdate extends Notification implements ShouldQueue {
    use Queueable;

    public $ticket_id, $subject, $nid, $nType;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket_id, $subject, $notification_to) {
        $this->ticket_id = $ticket_id;
        $this->subject = $subject;
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
        return ['mail', 'database', DbMailChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->subject("Ticket Replied")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString('You have an update for the ticket - <strong>' . $this->subject . "<strong>"))
            ->line("Click the button to see update")
            ->action('View Update', route('client.support.show', $this->ticket_id));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "Ticket Replied By Company",
            "link" => route('client.support.show', $this->ticket_id)
        ];
    }
}
