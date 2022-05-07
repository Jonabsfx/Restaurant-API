<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use UuidTrait, HasApiTokens, HasFactory, Notifiable;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'name',  
        'login', 
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
