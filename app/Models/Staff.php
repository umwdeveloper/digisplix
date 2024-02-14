<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public static function boot() {
        parent::boot();

        static::deleting(function (Staff $staff) {
            $notificationIds = $staff->user->notifications()->pluck('id');

            DB::transaction(function () use ($staff, $notificationIds) {
                NotificationType::whereIn('notification_id', $notificationIds)->delete();
            });

            $staff->user->notifications()->delete();

            ChMessage::where('from_id', $staff->user->id)->orWhere('to_id', $staff->user->id)->delete();

            $staff->user()->delete();
        });
    }
}
