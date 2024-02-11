<?php

namespace App\Notifications;

use App\Models\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ProjectCompleted extends Notification implements ShouldQueue {
    use Queueable;

    public $title;
    public $status;
    public $project_id;

    public $nid, $nType;

    /**
     * Create a new notification instance.
     */
    public function __construct($title, $status, $project_id) {
        $this->status = $status;
        $this->title = $title;
        $this->project_id = $project_id;
        $this->nid = $project_id;
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
            ->subject('Project Completed Successfully')
            ->greeting('Hi ' . $notifiable->name . ',')
            ->line(
                new HtmlString(
                    "We hope this email finds you well. We are pleased to inform you that the <strong>" . $this->title . "</strong> has been successfully Completed and delivered, meeting all the specified requirements and milestones outlined in the project scope."
                )
            )
            ->line("Our team has worked diligently to ensure that the project was executed with the highest level of quality and efficiency. We are confident that the final deliverables not only meet but potentially surpass your expectations.")
            ->line(new HtmlString(
                "Here are the key details regarding the completion:<br>"
                    . "<strong>Project Name:</strong> " . $this->title . "<br>"
                    . "<strong>Completion Date:</strong> " . date('d M, Y')
            ))
            ->line("It has been a pleasure working with you throughout this project, and we appreciate the collaboration and trust you placed in our team. We believe that the successful completion of this project is a testament to our commitment to delivering high-quality results.")
            ->line("If you have any questions or require further clarification on any aspect of the project, please do not hesitate to reach out. We are committed to ensuring your satisfaction and are available to address any concerns you may have.")
            ->line("Thank you once again for choosing DigiSplix for your project needs. We look forward to the opportunity to work with you on future endeavors.");
    }

    /**
     * Get the database representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toDatabase(object $notifiable): array {
        return [
            'message' => "Project Completed Successfully",
            "link" => route('client.projects.show', $this->project_id)
        ];
    }
}
