<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PartnerCreated extends Notification implements ShouldQueue {
    use Queueable;

    public $password;
    public $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($password) {
        $this->password = $password;
        $this->url = config('custom.partner_subdomain');
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->subject("Registration")
            ->greeting('Hi ' . $notifiable->name)
            ->line("You have been registered as a Sales Partner successfully! Please use the following credentials to login to Partner's Dashboard.")
            ->line(new HtmlString("Email: <strong>" . $notifiable->email . "</strong>"))
            ->line(new HtmlString("Password: <strong>" . $this->password . "</strong>"))
            ->action('Login', $this->url);
    }
}
