<?php

namespace Database\Factories;

use App\Models\Bevarage;
use Illuminate\Database\Eloquent\Factories\Factory;

class BevarageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Bevarage::class;
    public function definition()
    {
        return [
            //

            'name'=>$this->faker->name,
            'type'=>'softDrinks'
        ];
    }
}
