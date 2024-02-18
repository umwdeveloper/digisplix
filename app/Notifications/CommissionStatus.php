<?php

namespace App\Notifications;

use App\Models\Commission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CommissionStatus extends Notification implements ShouldQueue {
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
        if ($this->status == Commission::PAID) {
            return (new MailMessage)
                ->subject("Commission Paid! Your Hard Work Rewarded")
                ->greeting("Hi " . $notifiable->name . ",")
                ->line(new HtmlString("Exciting News — Your Commission has been processed, and the Payment is on its way! Soon, it'll be in your account."))
                ->line(new HtmlString('<strong>Commission: </strong>' . $this->commission . "%" . "<br>" .
                    '<strong>Commission Type: </strong>' . $this->commission_type . "<br>" .
                    '<strong>Project Name: </strong>' . $this->project . "<br>" .
                    '<strong>Business Name: </strong>' . $this->business_name))
                ->line(new HtmlString("Thanks for your hard work!"));
        } else if ($this->status == Commission::PROCESSING) {
            return (new MailMessage)
                ->subject("The Countdown Begins: Commission Processing Initiated")
                ->greeting("Hi " . $notifiable->name . ",")
                ->line(new HtmlString("Quick update: Your Commission is in the Processing pipeline! We'll keep you posted on the progress."))
                ->line(new HtmlString('<strong>Commission: </strong>' . $this->commission . "%" . "<br>" .
                    '<strong>Commission Type: </strong>' . $this->commission_type . "<br>" .
                    '<strong>Project Name: </strong>' . $this->project . "<br>" .
                    '<strong>Business Name: </strong>' . $this->business_name))
                ->line(new HtmlString("Your Patience is Valued and Appreciated."));
        } else {
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
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array {
        return [
            'message' => $this->status == Commission::PAID ? 'Commission Paid Successfully' : ($this->status == Commission::PROCESSING ? 'Commission Processing Initiated' : 'Commission Earned'),
            "link" => route('partner.sales.index')
        ];
    }
}
