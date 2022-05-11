<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Chef;

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
            'login' => $this->faker->unique()->safeEmail(),
            'password' => '1918',
        ];
    }
}
