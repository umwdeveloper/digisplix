<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentFailedPackageAdmin extends Notification implements ShouldQueue {
    use Queueable;

    public $plan, $name;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($plan, $name, $notification_to) {
        $this->plan = $plan;
        $this->name = $name;
        $this->notification_to = $notification_to;
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
            ->subject("Payment Failed")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('Payment Failed');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Payment Failed",
            "link" => route('staff.invoices.index')
        ];
    }
}
