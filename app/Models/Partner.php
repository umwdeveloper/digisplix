<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model {
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'commission',
        'facebook',
        'linkedin',
        'instagram'
    ];

    public function user() {
        return $this->morphOne(User::class, 'userable');
    }

    public function clients() {
        return $this->hasMany(Client::class);
    }

    public static function boot() {
        parent::boot();

        static::deleting(function (Partner $partner) {
            $partner->clients()->delete();
        });
    }
}
