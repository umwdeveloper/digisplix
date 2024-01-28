<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportReply extends Model {
    use HasFactory;

    protected $fillable = [
        'support_id',
        'user_id',
        'reply',
    ];

    public function support() {
        return $this->belongsTo(Support::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function notificationTypes() {
        return $this->morphMany(NotificationType::class, 'notifiable');
    }
}
