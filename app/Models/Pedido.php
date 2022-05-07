<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'status'
    ];

    public function funcionario()
    {
        return $this->belongsTo(Funcionario::class);
    }

    public function mesa()
    {
        return $this->belongsTo(Mesa::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}
