<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'title',
        'url',
        'business_name',
        'business_email',
        'business_phone',
        'joined_at',
        'followup_date'
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

    // public function getStatusAttribute() {
    //     return self::$statusLabels[$this->attributes['status']] ?? '';
    // }

    // public static function getStatusFromLabel($label) {
    //     return self::$statusLabels[$label] ?? null;
    // }
}
