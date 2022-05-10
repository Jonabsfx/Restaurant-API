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
            'id_waiter' => Waiter::factory(),
            'id_customer' => Customer::factory(),
            'id_table' => Table::factory(),
        ];
    }
}
