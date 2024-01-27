<?php

namespace App\Listeners;

use App\Models\NotificationType;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Events\NotificationSent;
use Illuminate\Queue\InteractsWithQueue;

class NotificationSentListener {
    /**
     * Create the event listener.
     */
    public function __construct() {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NotificationSent $event): void {
        $notification = $event->notification;

        $existingRecord = NotificationType::where('notification_id', $notification->id)->first();

        /** @var NotificationType $notification */
        if (!$existingRecord) {
            NotificationType::create([
                'notification_id' => $notification->id,
                'notifiable_id' => $notification->nid,
                'notifiable_type' => $notification->nType
            ]);
        }
    }
}
