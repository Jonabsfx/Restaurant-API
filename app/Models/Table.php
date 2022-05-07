<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    use HasFactory;
    public $incrementing = false;

    protected $fillable = [
        'number',
    ];

    public function orders()
    {
        return $this->hasMany(Orders::class);
    }
}