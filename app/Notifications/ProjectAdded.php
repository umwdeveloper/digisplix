<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ProjectAdded extends Notification implements ShouldQueue {
    use Queueable;

    public $name;
    public $project_id;
    public $title, $nid, $nType;

    /**
     * Create a new notification instance.
     */
    public function __construct($name, $project_id, $title, $nid) {
        $this->name = $name;
        $this->project_id = $project_id;
        $this->title = $title;
        $this->nid = $nid;
        $this->nType = Project::class;
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
            ->subject("Exciting News: New Project Started")
            ->greeting("Hi " . $this->name . ",")
            ->line("We are excited to share that following your successful payment, our team has initiated work on your project. For your convenience, we've set up a Client Dashboard where you can monitor the progress of your project in real-time.")
            ->line(new HtmlString("<strong>Project Name:</strong> " . $this->title))
            ->line("Feel free to access your dashboard anytime to stay updated on the latest developments. We appreciate your trust in us and look forward to delivering a successful outcome for your project.")
            ->line("Additionally, if you have any questions, require clarification, or wish to discuss any aspect of the project, our support team is available for you. Simply click on the chat option within your dashboard, and our team will be more than happy to assist you.")
            ->line("Thank you for choosing us. We look forward to delivering excellent results for your project.");
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            "message" => "New Project Started",
            "link" => route('client.projects.show', $this->project_id)
        ];
    }
}
