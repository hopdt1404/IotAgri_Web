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
            'FarmType' => 'Trang trại trồng trọt',
            'created_at' => Carbon::now(),
            'created_user' => 'Admin',
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 2,
            ],
            [
//                'FarmType' => 'Extensive and Intensive Farming',
                'FarmType' => 'Xen canh - thâm canh',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 3,
            ],
            [
//                'FarmType' => 'Subsistence Farming',
                'FarmType' => 'Khép kín - tự cung tự cấp',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 4,
            ],
            [
//                'FarmType' => 'Fish Farming',
                'FarmType' => 'Nuôi cá',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 5,
            ],
            [
//                'FarmType' => 'Pastoral Farming',
                'FarmType' => 'Chăn nuôi gia súc',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 6,
            ],
            [
//                'FarmType' => 'Mixed Farming',
                'FarmType' => 'Chăn nuôi tổng hợp',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );

        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 7,
            ],
            [
//                'FarmType' => 'Commercial Farming',
                'FarmType' => 'Canh tác thương mại',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );

        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 8,
            ],
            [
//                'FarmType' => 'Nomadic Farming',
                'FarmType' => 'Canh tác du mục',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );
        DB::table('FarmTypes')->updateOrInsert(
            [
                'FarmTypeID' => 9,
            ],
            [
//                'FarmType' => 'Poultry Farming',
                'FarmType' => 'Chăn nuôi gia cầm',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin'
            ]
        );

    }
}
