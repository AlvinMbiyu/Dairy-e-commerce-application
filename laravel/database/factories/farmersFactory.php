<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class farmersFactory extends Factory
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
            'Identification number' => $this->faker->Fid,
            'Name' => $this->faker->Name,
            'county' => $this->faker->county_id,
            'subcounty' => $this->faker->sc_id,
            'town' => $this->faker->town_id,
            'Phone' => $this->faker->Phone_no,
            'email' => $this->faker->email,
            'age' => $this->faker->age,
            'password' => Hash::make($this->faker->password)
        ];
    }
}
