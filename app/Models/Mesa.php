<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'numero',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class);
    }
}