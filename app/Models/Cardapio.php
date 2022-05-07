<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    public function itens()
    {
        return $this->hasMany(Item::class);
    }
}
