<?php

namespace App\Notifications;

use App\Models\Client;
use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ClientAdded extends Notification implements ShouldQueue {
    use Queueable;

    public $password;
    public $nid, $nType;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($password, $nid, $notification_to) {
        $this->password = $password;
        $this->nid = $nid;
        $this->nType = Client::class;
        $this->notification_to = $notification_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail', DbMailChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->subject("Welcome to the DigiSplix Family")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line("You have been registered successfully! Please use the following credentials to login to Client's Dashboard.")
            ->line(new HtmlString("Email: <strong>" . $notifiable->email . "</strong>"))
            ->line(new HtmlString("Password: <strong>" . $this->password . "</strong>"))
            ->action('Login', config('custom.client_subdomain'));;
    }
}
