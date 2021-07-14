<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FarmTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 1,
            ],
            [
            'FarmType' => 'Arable Farming',
            'created_at' => Carbon::now(),
            'created_user' => 'Admin',
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 2,
            ],
            [
                'FarmType' => 'Pastoral Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 3,
            ],
            [
                'FarmType' => 'Mixed Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 4,
            ],
            [
                'FarmType' => 'Subsistence Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 5,
            ],
            [
                'FarmType' => 'Commercial Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 6,
            ],
            [
                'FarmType' => 'Extensive and Intensive Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 7,
            ],
            [
                'FarmType' => 'Nomadic Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 8,
            ],
            [
                'FarmType' => 'Nomadic Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 9,
            ],
            [
                'FarmType' => 'Poultry Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 10,
            ],
            [
                'FarmType' => 'Fish Farming',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
    }
}
