<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Customer::class;
    public function definition()
    {
        return [
            //

            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'active' => 1,
        ];
    }
}
