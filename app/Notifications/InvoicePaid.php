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
            ->subject("Invoice Paid")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString('The invoice with number <strong>' . $this->invoice->number . '</strong> has been paid successfully for the amount <strong>$' . $this->price . '</strong>'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        $userable = $notifiable->userable_type === Staff::class ? 'staff' : 'client';
        return [
            'message' => "Invoice# " . $this->invoice->invoice_id . " has been paid",
            "link" => route($userable . '.invoices.index', $this->invoice->id)
        ];
    }
}
