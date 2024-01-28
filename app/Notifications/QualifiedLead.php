<?php

namespace App\Notifications;

use App\Models\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class QualifiedLead extends Notification implements ShouldQueue {
    use Queueable;

    public $name;
    public $nid, $nType;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $nid) {
        $this->name = $name;
        $this->nid = $nid;
        $this->nType = Client::class;
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
            ->subject('Lead Qualified')
            ->line(new HtmlString('<strong>' . $this->name . '</strong> has Qualified the lead.'));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => $this->name . ' has Qualified the lead',
            "link" => route('staff.leads.index')
        ];
    }
}
