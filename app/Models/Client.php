<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class Client extends Model {
    use HasFactory;

    // public $timestamps = false;

    protected $fillable = [
        'url',
        'business_name',
        'business_phone',
        'joined_at',
        'followup_date',
        'partner_id',
        'status',
        'active'
    ];

    const NEW_LEAD = 'new_lead';
    const CONTACTED = 'contacted';
    const FOLLOW_UP = 'follow_up';
    const IN_PROGRESS = 'in_progress';
    const FAILED = 'failed';
    const QUALIFIED = 'qualified';

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function partner() {
        return $this->belongsTo(Partner::class);
    }

    public function projects() {
        return $this->hasMany(Project::class);
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function commissions() {
        return $this->hasMany(Commission::class);
    }

    public function notificationTypes() {
        return $this->morphMany(NotificationType::class, 'notifiable');
    }

    public function emails() {
        return $this->hasMany(Email::class);
    }

    private static $statuses = [
        self::NEW_LEAD,
        self::CONTACTED,
        self::FOLLOW_UP,
        self::IN_PROGRESS,
        self::FAILED,
        self::QUALIFIED,
    ];

    public static function getStatuses() {
        return array_combine(self::$statuses, self::$statuses);
    }

    public static function getStatus($status) {
        return self::$statuses[$status];
    }

    private static $statusLabels = [
        self::NEW_LEAD => 'New Lead',
        self::CONTACTED => 'Contacted',
        self::FOLLOW_UP => 'Follow Up',
        self::IN_PROGRESS => 'In Progress',
        self::FAILED => 'Failed',
        self::QUALIFIED => 'Qualified',
    ];

    public static function getStatusLabels() {
        return self::$statusLabels;
    }

    public static function getStatusLabel($status) {
        return self::$statusLabels[$status];
    }

    private static $statusColors = [
        self::NEW_LEAD => '#06F7F0',
        self::CONTACTED => '#063AF6',
        self::FOLLOW_UP => '#E400F7',
        self::IN_PROGRESS => '#F75C06',
        self::FAILED => '#F70606',
        self::QUALIFIED => '#06F744',
    ];

    public static function getStatusColors() {
        return self::$statusColors;
    }

    public static function getStatusColor($status) {
        return self::$statusColors[$status];
    }

    // public function getStatusAttribute() {
    //     return self::$statusLabels[$this->attributes['status']] ?? '';
    // }

    // public static function getStatusFromLabel($label) {
    //     return self::$statusLabels[$label] ?? null;
    // }

    public static function boot() {
        parent::boot();

        static::deleting(function (Client $client) {

            $notificationIds = $client->user->notifications()->pluck('id');
            $notificationIds2 = NotificationType::where('notification_to', $client->user->id)
                ->pluck('notification_id');

            DB::transaction(function () use ($client, $notificationIds, $notificationIds2) {
                DatabaseNotification::whereIn('id', $notificationIds2)->delete();
                NotificationType::whereIn('notification_id', $notificationIds2)->delete();
                NotificationType::whereIn('notification_id', $notificationIds)->delete();
            });

            $client->user->notifications()->delete();

            ChMessage::where('from_id', $client->user->id)->orWhere('to_id', $client->user->id)->delete();

            $client->user()->delete();
            $client->projects()->delete();
        });

        static::addGlobalScope('order', function ($builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}
