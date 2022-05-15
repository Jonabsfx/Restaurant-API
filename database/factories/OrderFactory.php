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
            'waiter_id' => Waiter::factory(),
            'customer_id' => Customer::factory(),
            'table_id' => Table::select('*')->first(),
        ];
    }
}
