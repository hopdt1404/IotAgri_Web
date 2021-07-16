<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoilTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 1,
            ],
            [
                'name' => 'Sandy soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 2,
            ],
            [
                'name' => 'Clay Soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 3,
            ],
            [
                'name' => 'Silt Soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 4,
            ],
            [
                'name' => 'Peat Soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 5,
            ],
            [
                'name' => 'Chalk Soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('soil_types')->updateOrInsert(
            [
                'id' => 6,
            ],
            [
                'name' => 'Loam Soil',
                'info' => 'https://www.boughton.co.uk/products/topsoils/soil-types/',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );

    }
}
