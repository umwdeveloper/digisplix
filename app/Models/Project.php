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
        'progress',
        'billing_status',
        'current_status',
        'img'
    ];

    public function client() {
        return $this->belongsTo(Client::class);
    }

    public function phases() {
        return $this->hasMany(Phase::class);
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

    // public static function boot(): void {
    //     parent::boot();

    //     static::created(function ($createdProject) {
    //         $createdProject->phases()->createMany([
    //             ['name' => 'Planning'],
    //             ['name' => 'Designing'],
    //             ['name' => 'Development'],
    //             ['name' => 'Testing'],
    //         ]);
    //     });
    // }

    public static function boot() {
        parent::boot();

        static::addGlobalScope('order_project', function ($builder) {
            $builder->orderBy('created_at', 'desc');
        });
    }
}
