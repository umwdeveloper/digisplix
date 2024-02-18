<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PackagePaidAdmin extends Notification implements ShouldQueue {
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
            ->subject(ucfirst(strtolower($this->plan)) . " Plan Subscribed Successfully")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString(
                "We wanted to inform you that we have a New Subscriber for our Business Growth Plans. The client <strong>" . $this->name . "</strong>, has Successfully completed the subscription process."
            ))
            ->line(new HtmlString(
                "Here are some details:
                <br><strong>Client Name:</strong> " . $this->name .
                    "<br><strong>Subscription Plan:</strong> " . strtoupper($this->plan) . " - Business Growth Plan"
            ))
            ->line("Thank you for your attention to this matter.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => ucfirst(strtolower($this->plan)) . ' Plan subscribed by ' . $this->name,
            'link' => route('staff.invoices.index')
        ];
    }
}
