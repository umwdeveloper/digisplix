<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwoFA extends Model {
    use HasFactory;

    protected $table = '2_f_a_s';

    protected $fillable = [
        'user_id',
        'code'
    ];
}
