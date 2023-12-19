<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ProjectAdded extends Notification implements ShouldQueue {
    use Queueable;

    public $name;
    public $project_id;
    public $title;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $project_id, $title) {
        $this->name = $name;
        $this->project_id = $project_id;
        $this->title = $title;
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
            ->subject("Project created")
            ->greeting("Hi " . $this->name . ",")
            ->line(new HtmlString("A new project has been created"))
            ->line(new HtmlString("Project Title: <strong>" . $this->title . "</strong>"));
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "A new project has been created",
            "link" => route('client.projects.show', $this->project_id)
        ];
    }
}
