<?php

namespace App\Notifications;

use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PackageRenewed extends Notification implements ShouldQueue {
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
            ->subject(ucfirst(strtolower($this->plan)) . " Plan Renewed Successfully")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString("We hope this email finds you well. We are pleased to inform you that your current <strong>" . strtoupper(strtolower($this->plan)) . "</strong> - Business Growth Plan has been Successfully Renewed."))
            ->line("We greatly appreciate your continued partnership with us, and we are committed to providing you with the highest level of service and support. The Renewal process has been Completed, and you can continue to enjoy the benefits and features outlined in your existing plan.")
            ->line("If you have any questions or if there are specific aspects of your plan that you would like to discuss further, please do not hesitate to reach out to our customer support team. We are here to assist you and ensure that your experience with us remains positive and seamless.")
            ->line("Thank you once again for choosing DigiSplix as your trusted partner. We look forward to serving you and contributing to the success of your business.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => ucfirst(strtolower($this->plan)) . " Plan Renewed Successfully!",
            'link' => route('client.invoices.index')
        ];
    }
}
