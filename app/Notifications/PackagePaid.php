<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PackagePaid extends Notification implements ShouldQueue {
    use Queueable;

    public $plan;

    /**
     * Create a new notification instance.
     */
    public function __construct($plan) {
        $this->plan = $plan;
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
            ->subject("Package Subscription")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString("You have successfully subscribed to <strong>' . $this->plan . '</strong>"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => 'Package subscription successful',
            'link' => route('client.invoices.index')
        ];
    }
}
