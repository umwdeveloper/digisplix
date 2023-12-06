<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable, CanResetPassword;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'country',
        'country_code',
        'designation',
        'img',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function userable() {
        return $this->morphTo();
    }

    public function staff() {
        return $this->userable instanceof Staff ? $this->userable : null;
    }

    public function partner() {
        return $this->userable instanceof Partner ? $this->userable : null;
    }

    public function client() {
        return $this->userable instanceof Client ? $this->userable : null;
    }

    public function supports() {
        return $this->hasMany(Support::class);
    }

    public function replies() {
        return $this->hasMany(SupportReply::class);
    }

    public function getAvatarAttribute() {
        return $this->attributes['img'];
    }

    public function sendPasswordResetNotification($token) {
        $this->notify(new CustomResetPasswordNotification($token));
    }
}
