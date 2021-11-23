<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // NO_DEVICE, AGRICULTURE_SENSOR, PUMP
        // Ref: EchonetLite_over_Lora/Gateway/src/utilites/Helper.java
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 1,
            ],
            [
//                'DeviceType' => 'Sensing',
                'DeviceType' => 'Cảm biến',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 1,
            ],
            [
//                'DeviceType' => 'Sensing',
                'DeviceType' => 'Cảm biến',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 2,
            ],
            [
//                'DeviceType' => 'Sensing',
                'DeviceType' => 'Cảm biến độ ẩm đất',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 3,
            ],
            [
//                'DeviceType' => 'Sensing',
                'DeviceType' => 'Cảm biến nhiệt độ và độ ẩm không khí',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 4,
            ],
            [
//                'DeviceType' => 'Sensing',
                'DeviceType' => 'Cảm biến ánh sáng',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 5,
            ],
            [
//                'DeviceType' => 'Actuating',
                'DeviceType' => 'Máy bơm',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 6,
            ],
            [
//                'DeviceType' => 'Gateway',
                'DeviceType' => 'Trạm trung gian',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 7,
            ],
            [
//                'DeviceType' => 'Controlling',
                'DeviceType' => 'Bộ điều khiển',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );

    }
}
