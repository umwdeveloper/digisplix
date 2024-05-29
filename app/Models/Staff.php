<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class Staff extends Model {
    use HasFactory;

    public $timestamps = false;

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'staff_permissions')->withTimestamps();
    }

    public function notificationTypes() {
        return $this->morphMany(NotificationType::class, 'notifiable');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function (Staff $staff) {
            $notificationIds = $staff->user->notifications()->pluck('id');
            $notificationIds2 = NotificationType::where('notification_to', $staff->user->id)
                ->pluck('notification_id');

            DB::transaction(function () use ($staff, $notificationIds, $notificationIds2) {
                DatabaseNotification::whereIn('id', $notificationIds2)->delete();
                NotificationType::whereIn('notification_id', $notificationIds2)->delete();
                NotificationType::whereIn('notification_id', $notificationIds)->delete();
            });

            $staff->user->notifications()->delete();

            ChMessage::where('from_id', $staff->user->id)->orWhere('to_id', $staff->user->id)->delete();

            $staff->user()->delete();
        });
    }
}
