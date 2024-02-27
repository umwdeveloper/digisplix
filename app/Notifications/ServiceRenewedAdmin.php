<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ServiceRenewedAdmin extends Notification implements ShouldQueue {
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
            ->subject("Service Renewed: " . $this->invoice->category->name)
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString(
                "We are excited to inform you that <strong>" . $this->client . "</strong>, a valued Client of ours, has chosen to Renew their Subscription for our <strong>" . $this->invoice->category->name .
                    "</strong> services. We greatly appreciate <strong>" . $this->client . "'s</strong> continued trust in our services."
            ))
            ->line(new HtmlString(
                "Here are the details of the Renewal:<br>" .
                    "<strong>Client Name:</strong> " . $this->client . "<br>"
                    . "<strong>Service:</strong> " . $this->invoice->category->name
            ))
            ->line(new HtmlString("<strong>" . $this->client . "</strong> has Successfully Completed the Renewal process, ensuring uninterrupted access to our premium services. We are committed to providing the highest level of support and value to <strong>" . $this->client . "</strong> as they strive for business success."))
            ->line("Thank you for your attention to this matter.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Service Renewed: " . $this->invoice->category->name . " by " . $this->client,
            "link" => route('staff.invoices.index', $this->invoice->id)
        ];
    }
}
