<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Service::class;
    public function definition()
    {
        return [
            //
            'user_id' => function()
            {
              return User::factory()->create()->id;
            },
            'name' => 'some service',
            'token' => ['access_token'=>'fake-token'],
        ];
    }
}
