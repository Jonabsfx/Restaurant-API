<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chef>
 */
class ChefFactory extends Factory
{
    protected $model = Chef::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'login' => $this->faker->unique()->login(),
            'password' => '1918',
        ];
    }
}
