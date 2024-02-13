<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InvoicePaidAdmin extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $price, $nid, $nType, $clientName;
    public $manual;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $price, $nid, $clientName, $manual = false) {
        $this->invoice = $invoice;
        $this->price = $price;
        $this->nid = $nid;
        $this->nType = Invoice::class;
        $this->clientName = $clientName;
        $this->manual = $manual;
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
            ->subject("Good News: Invoice Paid")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString(
                "We wanted to inform you that we have Received the Payment for Invoice #<strong>" . $this->invoice->invoice_id .
                    "</strong> from our client, <strong>" . $this->clientName . "</strong>. The transaction has been processed Successfully, and the funds have been Deposited into our account."
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
            'message' => $this->manual ? "Invoice #" . $this->invoice->invoice_id . " Marked as Completed" : "Invoice #" . $this->invoice->invoice_id . " Paid Successfully",
            "link" => route('staff.invoices.index', $this->invoice->id)
        ];
    }
}
