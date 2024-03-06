<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

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
            ->subject("Unsuccessful Subscription Payment")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('I hope this message finds you well. We would like to bring to your attention that there has been a failure in processing the monthly subscription payment for one of our clients.')
            ->line(new HtmlString("
            Here are the key details<br>
            <strong>Client Name:</strong> " . $this->name . "<br>
            <strong>Subscription Plan:</strong> " . strtoupper($this->plan) . "
            "))
            ->line("Thank you for your prompt attention to this matter.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Unsuccessful Subscription Payment",
            "link" => route('staff.invoices.index')
        ];
    }
}
