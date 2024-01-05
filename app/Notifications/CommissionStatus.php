<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CommissionStatus extends Notification implements ShouldQueue {
    use Queueable;

    public $status, $project;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $project) {
        $this->status = $status;
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
            ->subject("Commission Status Updated")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString('Commission status for the project <strong>' . $this->project . '</strong> has been updated to <strong>' . $this->status . '</strong>'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => 'Commission status updated',
            "link" => route('partner.sales.index')
        ];
    }
}
