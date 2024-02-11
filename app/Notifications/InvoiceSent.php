<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceSent extends Notification implements ShouldQueue {
    use Queueable;

    public $name, $nid, $nType;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $nid) {
        $this->name = $name;
        $this->nid = $nid;
        $this->nType = Invoice::class;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array {
        return ['database'];
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => "Invoice sent to " . $this->name,
            "link" => route('staff.invoices.index')
        ];
    }
}
