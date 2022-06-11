<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Table;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Table>
 */
class TableFactory extends Factory
{
    protected $model = Table::class;
    
    public function definition()
    {
       $number = $this->faker->unique()->numberBetween(1,100);
       $model = Table::select('*')->where('number', '=', $number)->exists();
    
        if($model === false){
            return [
                'number' => $number
            ];}
        else{
            $table = Table::factory()
                     ->count(1)
                     ->create();
            return [
                'number' => $table->number
            ];
        }
    }
}
