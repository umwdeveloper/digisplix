<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class PaymentFailedAdmin extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $nid, $nType, $client;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $client, $nid, $notification_to) {
        $this->invoice = $invoice;
        $this->nid = $nid;
        $this->nType = Invoice::class;
        $this->notification_to = $notification_to;
        $this->client = $client;
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
            ->subject("Unsuccessful Subscription Payment")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line('I hope this message finds you well. We would like to bring to your attention that there has been a failure in processing the monthly subscription payment for one of our clients.')
            ->line(new HtmlString(
                "Here are the key details:
                <br><strong>Client Name:</strong> " . $this->client .
                    "<br><strong>Service:</strong> " . $this->invoice->category->name
            ))
            ->line("Thank you for your prompt attention to this matter.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Unsuccessful Subscription Payment",
            "link" => route('staff.invoices.index', $this->invoice->id)
        ];
    }
}
