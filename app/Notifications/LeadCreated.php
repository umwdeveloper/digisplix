<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class LeadCreated extends Notification implements ShouldQueue {
    use Queueable;

    public $name;

    /**
     * Create a new notification instance.
     */
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->subject("New Lead")
            ->line(new HtmlString("<strong>" . $this->name . "</strong> created a new lead"))
            ->action('View Lead', route('staff.leads.index'));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => $this->name . " created a new lead",
            "link" => route('staff.leads.index')
        ];
    }
}
