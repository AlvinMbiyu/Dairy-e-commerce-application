<?php

namespace Database\Seeders;

use App\Models\Deliveryperson;
use App\Models\DPpricing as ModelsDPpricing;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class DPpricing extends Seeder
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
        foreach (range(1, Deliveryperson::count()) as $value) {
            $DP = Deliveryperson::all()->random();
                if ($DP) {

                    DB::table('dppricing')->insert([
                        'Did' => $DP->Did,
                        'dpricing' => 10,
                        'per_litre' => true
                    ]);
                }
            
        }
    }
}
