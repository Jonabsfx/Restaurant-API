<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iten extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = [
        'name',
        'value',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
