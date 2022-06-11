<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\
{
    Order,
    Table,
    Waiter,
    Customer
};

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    
    public function definition()
    {
        return [
            'waiter_id' => Waiter::select('id')->inRandomOrder()->first(),
            'customer_id' => Customer::select('id')->inRandomOrder()->first(),
            'table_id' => Table::select('id')->inRandomOrder()->first(),
        ];
    }
}
