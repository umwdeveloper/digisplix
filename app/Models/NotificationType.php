<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model {
    use HasFactory;

    protected $fillable = [
        'notification_id',
        'notifiable_type',
        'notifiable_id'
    ];

    public function notifiable() {
        return $this->morphTo();
    }
}
