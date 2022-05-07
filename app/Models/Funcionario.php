<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Funcionario extends Authenticatable
{
    use UuidTrait, HasApiTokens, HasFactory, Notifiable;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'nome',  
        'login', 
        'senha',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
