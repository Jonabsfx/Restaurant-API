<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Iten;
use App\Models\Menu;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Iten>
 */
class ItenFactory extends Factory
{
    protected $model = Iten::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'value' => $this->faker->decimal(),
            'id_menu' => Menu::factory(),
        ];
    }
}
