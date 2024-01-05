<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CommissionCreated extends Notification implements ShouldQueue {
    use Queueable;

    public $project;

    /**
     * Create a new notification instance.
     */
    public function __construct($project) {
        $this->project = $project;
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
            ->subject("Commission Created")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString('A new commission was created for the <strong>' . $this->project . '</strong> project'));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            //
        ];
    }
}
