<?php

namespace App\Notifications\Channels;

use App\Models\Email;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Notifications\Notification;

class DbMailChannel {
    public function send(object $notifiable, Notification $notification) {
        $message = $notification->toMail($notifiable)->toArray();

        $greeting = [$message['greeting']];
        $action = ['actionText' => $message['actionText'], 'actionUrl' => $message['actionUrl']];

        $lines = array_map(function ($line) {
            if ($line instanceof Htmlable) {
                return $line->toHtml();
            }
            return $line;
        }, $message['introLines']);

        $lines = array_merge($greeting, $lines, $action);
        $dbMessage = json_encode($lines);

        Email::create([
            'client_id' => $notifiable->userable_id,
            'subject' => $message['subject'],
            'message' => $dbMessage
        ]);
    }
}
