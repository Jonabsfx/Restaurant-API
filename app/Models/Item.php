<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'nome',
    ];

    public function cardapio()
    {
        return $this->belongsTo(Cardapio::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
