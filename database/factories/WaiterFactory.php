<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Waiter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Waiter>
 */
class WaiterFactory extends Factory
{
    protected $model = Waiter::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'login' => $this->faker->unique()->login(),
            'password' => '1918',
        ];
    }
}
