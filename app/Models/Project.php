<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model {
    use HasFactory;

    protected $fillable = [
        'client_id',
        'name',
        'description',
        'deadline',
        'billing_status',
        'current_status',
        'img'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    private static $statusLabels = [
        "Ongoing",
        "Completed"
    ];

    public static function getStatusLabels() {
        return self::$statusLabels;
    }

    private static $billingLabels = [
        "Overdue",
        "Paid"
    ];

    public static function getBillingLabels() {
        return self::$billingLabels;
    }
}
