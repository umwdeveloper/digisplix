<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;
use Illuminate\Auth\Notifications\ResetPassword;

class CustomResetPasswordNotification extends ResetPassword {
    use Queueable;

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable) {
        // Call the parent toMail method to get the default mail message
        $mailMessage = parent::toMail($notifiable);

        // Customize the subject
        $mailMessage->subject('Reset password');

        // Return the customized mail message
        return $mailMessage;
    }
}
