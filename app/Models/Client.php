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

    public function user() {
        return $this->morphOne('App\User', 'userable');
    }
}
