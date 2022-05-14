<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, UuidTrait;
    public $incrementing = false;
    protected $keyType = 'uuid';

    protected $fillable = 
    [   
        'waiter_id',
        'table_id',
        'customer_id',
    ]; 
    
    public function waiter()
    {
        return $this->belongsTo(Waiter::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function itens()
    {
        return $this->belongsToMany(Iten::class);
    }
}
