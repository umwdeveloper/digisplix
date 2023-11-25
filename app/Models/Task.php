<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model {
    use HasFactory;

    protected $fillable = [
        "phase_id",
        "task",
        "status"
    ];

    public function phase() {
        return $this->belongsTo(Phase::class);
    }
}
