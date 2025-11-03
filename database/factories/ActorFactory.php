<?php

namespace Database\Factories;

use App\Models\Actor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActorFactory extends Factory
{
    protected $model = Actor::class;

    public function definition(): array
    {
        return [
            'email' => $this->faker->unique(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'height' => $this->faker->randomFloat(2, 100, 200),
            'weight' => $this->faker->randomFloat(2, 30, 200),
            'gender' => $this->faker->randomElement(['male','female', null]),
            'age' => $this->faker->numberBetween(18, 60),
        ];
    }
}
