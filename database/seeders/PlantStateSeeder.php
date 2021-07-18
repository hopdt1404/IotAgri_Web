<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantStateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 1
            ],
            [
                'name' => 'Sprout',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 2
            ],
            [
                'name' => 'Seedling',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 3
            ],
            [
                'name' => 'Vegetative',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 4
            ],
            [
                'name' => 'Budding',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 5
            ],
            [
                'name' => 'Flowering',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_states')->updateOrInsert(
            [
                'id' => 6
            ],
            [
                'name' => 'Ripening',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );

    }
}
