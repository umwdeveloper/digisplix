<?php

namespace App\Notifications;

use App\Models\Invoice;
use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InvoiceOverdue extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $nid, $nType, $price;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $nid, $price, $notification_to) {
        $this->invoice = $invoice;
        $this->nid = $nid;
        $this->nType = Invoice::class;
        $this->price = $price;
        $this->notification_to = $notification_to;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['mail', 'database', DbMailChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage {
        return (new MailMessage)
            ->subject("Urgent: Overdue Invoice - Action Required")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString(
                "We hope this email finds you well. We've noticed that Invoice <strong>#" . $this->invoice->invoice_id . "</strong> is overdue as of <strong>" . date('d M, Y', strtotime($this->invoice->due_date)) . "</strong>. Your prompt attention to this matter is crucial."
            ))
            ->line(new HtmlString(
                "Please settle the outstanding amount of <strong>$" . number_format($this->price, 0, ',') . "</strong> at your earliest convenience to avoid any service interruptions."
            ))
            ->line(new HtmlString(
                "<strong>Invoice ID:</strong> " . $this->invoice->invoice_id . "<br>"
                    . "<strong>Amount Due:</strong> $" . number_format($this->price, 0, ',') . "<br>"
                    . "<strong>Due Date:</strong> " . date('d M, Y', strtotime($this->invoice->due_date))
            ))
            ->line("You can make the payment through Debit/Credit Card, CashApp, ApplePay, GooglePay, and Bank/Wire/ACH Transfer. If you've already processed the payment, kindly disregard this message.")
            ->line(new HtmlString(
                "Feel free to contact our sales department at <a href='mailto:sales@digisplix.com'>sales@digisplix.com</a> for any assistance."
            ))
            ->line("Thank you for your prompt cooperation.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => 'Invoice Overdue - Action Required',
            "link" => route('client.invoices.index')
        ];
    }
}
