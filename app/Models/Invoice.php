<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    use HasFactory;

    const PENDING = 'pending';
    const PAID = 'paid';
    const OVERDUE = 'overdue';
    const DRAFT = 'draft';
    const RECURRING = 'recurring';
    const CANCELLED = 'cancelled';

    private static $statuses = [
        self::PENDING,
        self::PAID,
        self::OVERDUE,
        self::DRAFT,
        self::RECURRING,
        self::CANCELLED,
    ];

    public static function getStatuses() {
        return array_combine(self::$statuses, self::$statuses);
    }

    public static function getStatus($status) {
        return self::$statuses[$status];
    }

    private static $statusLabels = [
        self::PENDING => 'Pending',
        self::PAID => 'Paid',
        self::OVERDUE => 'Overdue',
        self::DRAFT => 'Draft',
        self::RECURRING => 'Recurring',
        self::CANCELLED => 'Cancelled',
    ];

    public static function getStatusLabels() {
        return self::$statusLabels;
    }

    public static function getStatusLabel($status) {
        return self::$statusLabels[$status];
    }

    private static $statusColors = [
        self::PENDING => '#06F7F0',
        self::PAID => '#063AF6',
        self::OVERDUE => '#E400F7',
        self::DRAFT => '#F75C06',
        self::RECURRING => '#F70606',
        self::CANCELLED => '#06F744',
    ];

    public static function getStatusColors() {
        return self::$statusColors;
    }

    public static function getStatusColor($status) {
        return self::$statusColors[$status];
    }
}
