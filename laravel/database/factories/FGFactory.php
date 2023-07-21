<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FGFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'id' => $this->faker->id,
            'members' => $this->faker->members,
            'price_per_litre' => $this->faker->price_per_litre,
            ''
        ];
    }
}
