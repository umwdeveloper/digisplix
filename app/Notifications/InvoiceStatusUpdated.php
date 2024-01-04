<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InvoiceStatusUpdated extends Notification implements ShouldQueue {
    use Queueable;

    public $name, $status, $id;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $status, $id) {
        $this->name = $name;
        $this->status = $status;
        $this->id = $id;
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
            ->subject("Status updated")
            ->greeting("Hi " . $this->name . ",")
            ->line(new HtmlString("Invoice status has been updated to <strong>" . $this->status . "</strong>"));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => "Invoice status has been updated to " . $this->status,
            "link" => route('client.invoices.show', $this->id)
        ];
    }
}
