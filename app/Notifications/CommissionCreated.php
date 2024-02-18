<?php

namespace App\Notifications;

use App\Models\Commission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CommissionCreated extends Notification implements ShouldQueue {
    use Queueable;

    public $status, $project, $commission, $commission_type, $business_name;
    public $nid, $nType;
    public $notification_to;

    /**
     * Create a new notification instance.
     */
    public function __construct($status, $project, $commission, $commission_type, $business_name, $nid, $notification_to) {
        $this->status = $status;
        $this->project = $project;
        $this->commission = $commission;
        $this->commission_type = $commission_type;
        $this->business_name = $business_name;
        $this->nid = $nid;
        $this->nType = Commission::class;
        $this->notification_to = $notification_to;
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
            ->subject("Great News! You've Earned a Commission")
            ->greeting("Hi " . $notifiable->name . ",")
            ->line(new HtmlString("We hope this email finds you well. We're thrilled to share the Great News that your hard work has Paid off, and you've Earned a well-deserved Commission. Congratulations! 🎉"))
            ->line(new HtmlString('<strong>Commission: </strong>' . $this->commission . "%" . "<br>" .
                '<strong>Commission Type: </strong>' . $this->commission_type . "<br>" .
                '<strong>Project Name: </strong>' . $this->project . "<br>" .
                '<strong>Business Name: </strong>' . $this->business_name))
            ->line(new HtmlString("To ensure a swift Payment process, please reach out to our Support team through your dashboard or contact us at WhatsApp and share your Account details."))
            ->line(new HtmlString("Thanks for your hard work!"));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => 'Commission Earned',
            "link" => route('partner.sales.index')
        ];
    }
}
