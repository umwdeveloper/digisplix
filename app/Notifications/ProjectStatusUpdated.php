<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ProjectStatusUpdated extends Notification implements ShouldQueue {
    use Queueable;

    public $title;
    public $status;
    public $project_id;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $status, $project_id) {
        $this->status = $status;
        $this->title = $title;
        $this->project_id = $project_id;
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
            ->subject('Project Status Updated')
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line(
                new HtmlString("Status for the project <strong>"
                    . $this->title
                    . "</strong> has been updated to <strong>" . $this->status . "</strong>")
            );
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "Project status updated",
            "link" => route('client.projects.show', $this->project_id)
        ];
    }
}
