<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phase extends Model {
    use HasFactory;

    protected $fillable = [
        "project_id",
        "name",
        "progress",
        "status"
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function tasks() {
        return $this->hasMany(Task::class);
    }
}
