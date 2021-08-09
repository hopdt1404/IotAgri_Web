<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Sensing')->updateOrInsert(
            [
                'SensingID' => 1,
            ],
            [
                // Todo device id in 1-5
                'DeviceID' => 1,
                'PlotID' => 1,
                'SoilMoisture' => 0.275984,
                'Humidity' => 32.8,
                'Temperature' => 24.3,
                'LightLevel' => 3360,
                'TimeOfMeasurement' => Carbon::now(),
            ]
        );
    }
}
