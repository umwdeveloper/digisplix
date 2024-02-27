<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PackageRenewedAdmin extends Notification implements ShouldQueue {
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
            ->subject(ucfirst(strtolower($this->plan)) . " Plan Re-Subscribed Successfully")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString(
                "We are excited to inform you that <strong>" . $this->name . "</strong>, a valued Client of ours, has chosen to Renew their Subscription for our Business Growth Plan. We greatly appreciate <strong>" . $this->name . "'s</strong> continued trust in our services."
            ))
            ->line(new HtmlString(
                "Here are the details of the Renewal:
                <br><strong>Client Name:</strong> " . $this->name .
                    "<br><strong>Subscription Plan:</strong> " . strtoupper($this->plan) . " - Business Growth Plan"
            ))
            ->line(new HtmlString(
                "<strong>" . $this->name .
                    "</strong> has Successfully Completed the Renewal process, ensuring uninterrupted access to our premium services. We are committed to providing the highest level of support and value to <strong>" . $this->name . "</strong> as they strive for business success."
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
            "message" => ucfirst(strtolower($this->plan)) . ' Plan Re-Subscribed by ' . $this->name,
            'link' => route('staff.invoices.index')
        ];
    }
}
