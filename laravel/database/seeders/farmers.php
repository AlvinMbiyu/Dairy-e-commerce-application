<?php

namespace Database\Seeders;

use App\Models\FarmerGroups;
use App\Models\Subcounty;
use App\Models\Town;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class farmers extends Seeder
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
        foreach (range(1, 100000) as $value) {
            $subcounty = Subcounty::all()->random();
            $group = FarmerGroups::all()->random();
            // Check if the subcounty exists
            if ($subcounty) {
                // Retrieve a town associated with the subcounty
                $town = Town::where('sc_id', $subcounty->id)->first();

                // Check if the town exists
                if ($town) {

                    DB::table('farmers')->insert([
                        'Fid' => $faker->unique()->randomNumber(8),
                        'Name'      => $faker->name,
                        'county_id' => $subcounty->county_id,
                        'sc_id' => $subcounty->id,
                        'town_id' => $town->id,
                        'password'  => $faker->password,
                        'email'     => $faker->email,
                        'Phone_no'  => $faker->phoneNumber,
                        'age'       => $faker->numberBetween(18, 65),
                        'Gid'       => $group->id
                    ]);
                }
            }
        }
    }
}
