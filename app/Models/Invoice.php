<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model {
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'client_id',
        'category_id',
        'invoice_from',
        'invoice_to',
        'status',
        'due_date',
        'terms_n_conditions',
        'note',
        'recurring',
        'start_from',
        'duration',
        'account_holder_name',
        'bank_name',
        'ifsc_code',
        'account_number',
        'sent'
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function items() {
        return $this->hasMany(InvoiceItem::class);
    }

    public function notificationTypes() {
        return $this->morphMany(NotificationType::class, 'notifiable');
    }

    public function getTotalPriceAttribute() {
        return $this->items->sum('total_price');
    }

    const PENDING = 'pending';
    const PAID = 'paid';
    const OVERDUE = 'overdue';
    const DRAFT = 'draft';
    const CANCELLED = 'cancelled';

    private static $statuses = [
        self::PENDING,
        self::PAID,
        self::OVERDUE,
        self::DRAFT,
        self::CANCELLED,
    ];

    public static function getStatuses() {
        return array_combine(self::$statuses, self::$statuses);
    }

    public static function getStatus($status) {
        return self::$statuses[$status];
    }

    private static $statusLabels = [
        self::PENDING => 'Unpaid',
        self::PAID => 'Paid',
        self::OVERDUE => 'Overdue',
        self::DRAFT => 'Draft',
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
        self::CANCELLED => '#06F744',
    ];

    public static function getStatusColors() {
        return self::$statusColors;
    }

    public static function getStatusColor($status) {
        return self::$statusColors[$status];
    }

    public static function boot() {
        parent::boot();

        static::addGlobalScope('orderInvoice', function ($builder) {
            $builder->orderBy('invoices.created_at', 'desc');
        });
    }
}
