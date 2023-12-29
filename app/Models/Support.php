<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JamesMills\LaravelTimezone\Facades\Timezone;

class Support extends Model {
    use HasFactory;

    protected $fillable  = [
        'user_id',
        'subject',
        'description',
        'status',
        'priority',
        'department'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function replies() {
        return $this->hasMany(SupportReply::class);
    }

    public function attachments() {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    const OPEN = 'open';
    const AWAITING_USER_RESPONSE = 'awaiting_user_response';
    const USER_REPLIED = 'user_replied';
    const CLOSED = 'closed';

    private static $statuses = [
        self::OPEN,
        self::AWAITING_USER_RESPONSE,
        self::USER_REPLIED,
        self::CLOSED,
    ];

    public static function getStatuses() {
        return array_combine(self::$statuses, self::$statuses);
    }

    public static function getStatus($status) {
        return self::$statuses[$status];
    }

    private static $statusLabels = [
        self::OPEN => 'Open',
        self::AWAITING_USER_RESPONSE => 'Awaiting User Response',
        self::USER_REPLIED => 'User Replied',
        self::CLOSED => 'Closed',
    ];

    public static function getStatusLabels() {
        return self::$statusLabels;
    }

    public static function getStatusLabel($status) {
        return self::$statusLabels[$status];
    }

    private static $statusColors = [
        self::OPEN => '#3596f7',
        self::AWAITING_USER_RESPONSE => '#ffb22b',
        self::USER_REPLIED => '#00e200',
        self::CLOSED => '#ff3535',
    ];

    public static function getStatusColors() {
        return self::$statusColors;
    }

    public static function getStatusColor($status) {
        return self::$statusColors[$status];
    }

    public function getCreatedAtAttribute($value) {
        return Carbon::createFromTimestamp(strtotime($value))
            ->timezone(config('app.timezone'));
    }
}
