<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class StaffCreated extends Notification implements ShouldQueue {
    use Queueable;

    public $password;
    public $url;

    /**
     * Create a new notification instance.
     */
    public function __construct($password) {
        $this->password = $password;
        $this->url = config('custom.staff_subdomain');
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
            ->subject("Welcome to the DigiSplix’s Team")
            ->greeting('Hi ' . $notifiable->name)
            ->line('You have been registered successfully as our team member. Please use the following credentials to login to your Dashboard.')
            ->line(new HtmlString("Email: <strong>" . $notifiable->email . "</strong>"))
            ->line(new HtmlString("Password: <strong>" . $this->password . "</strong>"))
            ->action('Login', $this->url);
    }
}
