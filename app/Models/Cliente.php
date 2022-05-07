<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'nome', 
        'cpf'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
}
