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
            ->subject("Action Required: Invoice Ready for Payment")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('We are thrilled to let you know that your invoice for the upcoming project is now prepared and accessible for payment. To proceed, kindly log in to your dashboard on our platform and complete the payment process.')
            ->line(new HtmlString(
                "<strong>Invoice ID:</strong> " . $this->invoice->invoice_id . "<br>"
                    . "<strong>Amount Due:</strong> $" . number_format($this->price, 0, ',') . "<br>"
                    . "<strong>Invoice Status:</strong> Unpaid<br>"
                    . "<strong>Due Date:</strong> " . date('d M, Y', strtotime($this->invoice->due_date))
            ))
            ->line('Your prompt attention to this matter is greatly appreciated, as settling the invoice will enable us to kickstart the project without any delays. We are eager to dive into the work and deliver exceptional results for you.')
            ->line('If you encounter any issues or have any questions regarding the payment process, please do not hesitate to reach out. We are here to assist you every step of the way.')
            ->line('Thank you for choosing us for your project. We look forward to a successful collaboration.');
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "New Invoice Received",
            "link" => route('client.invoices.index', $this->invoice->id)
        ];
    }
}
