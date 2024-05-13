<?php

namespace App\Notifications;

use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PaymentFailedPackage extends Notification implements ShouldQueue {
    use Queueable;

    public $plan;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($plan, $notification_to) {
        $this->plan = $plan;
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
            ->subject("Unsuccessful Subscription Payment")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('We regret to inform you that we encountered an issue while processing the monthly payment for your subscription to the Business Growth Plan. Our system attempted to deduct the payment from your account, but the transaction was unsuccessful.')
            ->line('To avoid any interruption in services, we kindly request you to check and update your payment information as soon as possible. You can do so by logging into your account, or if needed, contacting your financial institution.')
            ->line(new HtmlString("If you have any questions or concerns, please don't hesitate to reach out to our customer support at " . "<a href='mailto:sales@digisplix.com'>sales@digisplix.com.</a>"))
            ->line('We apologize for any inconvenience this may have caused and appreciate your prompt attention to this matter.')
            ->line('Thank you for your understanding.');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => "Unsuccessful Subscription Payment",
            'link' => route('client.invoices.index')
        ];
    }
}
