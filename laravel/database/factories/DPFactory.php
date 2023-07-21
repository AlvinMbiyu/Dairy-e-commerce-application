<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class DPFactory extends Factory
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
            'Identification number' => $this->faker->Did,
            'Name' => $this->faker->Name,
            'county' => $this->faker->county_id,
            'subcounty' => $this->faker->sc_id,
            'town' => $this->faker->town_id,
            'Phone number' => $this->faker->Phone_no,
            'email' => $this->faker->email,
            'age' => $this->faker->age,
            'password' => Hash::make($this->faker->password),
            'Operating vehicle' => $this->faker->Op_vehicle,
            'vehicle license plate' => $this->faker->vehicle_no
        ];
    }
}
