<?php

namespace App\Notifications;

use App\Models\Support;
use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SupportCreatedClient extends Notification implements ShouldQueue {
    use Queueable;

    public $ticket_id, $nid, $nType;
    public $notification_to, $clientName;

    /**
     * Create a new notification instance.
     */
    public function __construct($ticket_id, $notification_to, $clientName) {
        $this->ticket_id = $ticket_id;
        $this->nid = $ticket_id;
        $this->nType = Support::class;
        $this->notification_to = $notification_to;
        $this->clientName = $clientName;
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
            ->subject("Ticket Opened")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('A new support ticket was opened successfully.')
            ->action('View Ticket', route('client.support.show', $this->ticket_id));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => "A new ticket was opened",
            "link" => route('client.support.show', $this->ticket_id)
        ];
    }
}
