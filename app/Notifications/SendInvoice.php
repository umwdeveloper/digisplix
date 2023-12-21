<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class SendInvoice extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $price;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $price) {
        $this->invoice = $invoice;
        $this->price = $price;
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
            ->subject("Digisplix Invoice")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('Please pay the following invoice before the due date')
            ->line(new HtmlString("Invoice ID: <strong>" . $this->invoice->invoice_id . "</strong>"))
            ->line(new HtmlString("Total Price: <strong>$" . $this->price . "</strong>"))
            ->line(new HtmlString("Due Date: <strong>" . $this->invoice->due_date . "</strong>"));
    }
}
