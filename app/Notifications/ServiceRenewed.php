<?php

namespace App\Notifications;

use App\Models\Invoice;
use App\Notifications\Channels\DbMailChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ServiceRenewed extends Notification implements ShouldQueue {
    use Queueable;

    public Invoice $invoice;
    public $nid, $nType;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct(Invoice $invoice, $nid, $notification_to) {
        $this->invoice = $invoice;
        $this->nid = $nid;
        $this->nType = Invoice::class;
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
            ->subject("Service Renewed: " . $this->invoice->category->name)
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString("We hope this email finds you well. We are pleased to inform you that your current service <strong>" . $this->invoice->category->name . "</strong> has been Successfully Renewed."))
            ->line(new HtmlString("We greatly appreciate your continued partnership with us, and we are committed to providing you with the highest level of service and support. The Renewal process has been Completed."))
            ->line("If you have any questions or if there are specific aspects that you would like to discuss further, please do not hesitate to reach out to our customer support team. We are here to assist you and ensure that your experience with us remains positive and seamless.")
            ->line("Thank you once again for choosing DigiSplix as your trusted partner. We look forward to serving you and contributing to the success of your business.");
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => "Service Renewed: " . $this->invoice->category->name,
            "link" => route('client.invoices.index', $this->invoice->id)
        ];
    }
}
