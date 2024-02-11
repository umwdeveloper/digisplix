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
            ->subject(ucfirst($this->plan) . "Plan Subscribed Successfully")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString("Congratulations on taking the exciting step of Subscribing to our <strong>" . strtoupper($this->plan) . "</strong> - Business Growth Plan! 🎉 We're thrilled to have you on board and can't wait to support your business journey."))
            ->line("Thank you for choosing DigiSplix as your partner in growth. We are committed to delivering valuable insights, strategic digital marketing solutions, and resources to propel your online presence and elevate your business to new heights.")
            ->line("If you have any questions or need assistance along the way, feel free to reach out to us via Chat option within your dashboard, and our team will be more than happy to assist you. We're here to ensure your experience with our Business Growth Plan is seamless and rewarding.")
            ->line("Wishing you Continued Success and Prosperity!");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            "message" => ucfirst($this->plan) . " Plan Subscribed Successfully!",
            'link' => route('client.invoices.index')
        ];
    }
}
