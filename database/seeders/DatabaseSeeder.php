<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DeviceTypeSeeder::class,
            FarmTypeSeeder::class,
//            LocateSeeder::class,
            PlantStateSeeder::class,
            PlantTypeSeeder::class,
            PlotTypeSeeder::class,
//            PlotSeeder::class,
            SoilTypeSeeder::class,
            UserSeeder::class,
        ]);
    }
}
