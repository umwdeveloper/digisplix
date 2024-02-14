<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partner extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'commission',
        'facebook',
        'linkedin',
        'instagram'
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public function notificationTypes() {
        return $this->morphMany(NotificationType::class, 'notifiable');
    }

    public static function boot() {
        parent::boot();

        static::deleting(function (Partner $partner) {
            $notificationIds = $partner->user->notifications()->pluck('id');

            DB::transaction(function () use ($partner, $notificationIds) {
                NotificationType::whereIn('notification_id', $notificationIds)->delete();
            });

            $partner->user->notifications()->delete();
            $partner->clients()->delete();

            ChMessage::where('from_id', $partner->user->id)->orWhere('to_id', $partner->user->id)->delete();

            $partner->user()->delete();
        });
    }
}
