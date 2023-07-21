<?php

namespace Database\Seeders;

use App\Models\County;
use App\Models\FarmerGroups as ModelsFarmerGroups;
use App\Models\Subcounty;
use App\Models\Town;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class farmergroups extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        foreach (range(1, 1450) as $value) {
            $subcounty = Subcounty::all()->random();
            // Check if the subcounty exists
            if ($subcounty) {
                // Retrieve a town associated with the subcounty
                $town = Town::where('sc_id', $subcounty->id)->first();

                // Check if the town exists
                if ($town) {
                    // Create a fake farmer group

                    ModelsFarmerGroups::create([
                        'id' => $faker->unique()->randomNumber(8),
                        'county_id' => $subcounty->county_id,
                        'sc_id' => $subcounty->id,
                        'town_id' => $town->id,
                        'price_per_litre' => $faker->numberBetween(40, 50),
                    ]);
                }
            }
        }
    }
}
