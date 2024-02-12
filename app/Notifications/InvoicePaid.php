<?php

namespace App\Notifications;

use App\Models\Invoice;
use App\Models\Staff;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InvoicePaid extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $price, $nid, $nType;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $price, $nid) {
        $this->invoice = $invoice;
        $this->price = $price;
        $this->nid = $nid;
        $this->nType = Invoice::class;
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
            ->subject("Thank You for Your Payment - Invoice Cleared")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('We wanted to express our sincere appreciation for your prompt attention to the invoice. We have Received the payment, and we are pleased to confirm that your Invoice has been cleared.')
            ->line(new HtmlString(
                "<strong>Invoice ID:</strong> " . $this->invoice->invoice_id . "<br>"
                    . "<strong>Amount Paid:</strong> $" . $this->price . "<br>"
                    . "<strong>Invoice Status:</strong> Paid"
            ))
            ->line("Your timely cooperation is invaluable, and we are excited to move forward with your project. If there is anything specific you would like to discuss or if you have additional questions, please feel free to reach out.")
            ->line("Once again, thank you for choosing our services. We look forward to delivering excellent results and a successful collaboration.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Invoice #" . $this->invoice->invoice_id . " Paid Successfully",
            "link" => route('client.invoices.index', $this->invoice->id)
        ];
    }
}
