<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model {
    use HasFactory;

    protected $fillable = [
        'client_id',
        'project_id',
        'deal_date',
        'deal_size',
        'commission',
        'status',
        'type'
    ];

    const EARNED = 'earned';
    const PROCESSING = 'processing';
    const PAID = 'paid';

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function project() {
        return $this->belongsTo(Project::class);
    }

    private static $statuses = [
        self::EARNED,
        self::PROCESSING,
        self::PAID,
    ];

    public static function getStatuses() {
        return array_combine(self::$statuses, self::$statuses);
    }

    public static function getStatus($status) {
        return self::$statuses[$status];
    }

    private static $statusLabels = [
        self::EARNED => 'Earned',
        self::PROCESSING => 'Processing',
        self::PAID => 'Paid',
    ];

    public static function getStatusLabels() {
        return self::$statusLabels;
    }

    public static function getStatusLabel($status) {
        return self::$statusLabels[$status];
    }

    private static $statusColors = [
        self::EARNED => '#00e200',
        self::PROCESSING => '#ffb22b',
        self::PAID => 'green',
    ];

    public static function getStatusColors() {
        return self::$statusColors;
    }

    public static function getStatusColor($status) {
        return self::$statusColors[$status];
    }
}
