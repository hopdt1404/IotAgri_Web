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
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 1,
            ],
            [
                'DeviceType' => 'Sensing',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 2,
            ],
            [
                'DeviceType' => 'Actuating',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 3,
            ],
            [
                'DeviceType' => 'Gateway',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('DeviceTypes')->updateOrInsert(
            [
                'DeviceTypeID' => 4,
            ],
            [
                'DeviceType' => 'Controlling',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );

    }
}
