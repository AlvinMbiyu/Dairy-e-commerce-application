<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class retailerFactory extends Factory
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
            'Name' => $this->faker->Name,
            'Business Name' => $this->faker->BName,
            'county' => $this->faker->county_id,
            'subcounty' => $this->faker->sc_id,
            'town' => $this->faker->town_id,
            'password' => Hash::make($this->faker->password),
            'email' => $this->faker->email,
            'Phone' => $this->faker->Phone_no,
            'age' => $this->faker->age
        ];
    }
}
