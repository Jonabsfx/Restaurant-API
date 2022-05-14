<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiter extends User
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
