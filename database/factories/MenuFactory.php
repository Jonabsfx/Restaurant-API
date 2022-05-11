<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Menu;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{   
    protected $model = Menu::class;
    
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
        ];
    }
}
