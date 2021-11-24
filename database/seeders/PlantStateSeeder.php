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
//                'name' => 'Sprout',
                'name' => 'Hạt',
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
//                'name' => 'Seedling',
                'name' => 'Cây con',
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
//                'name' => 'Vegetative',
                'name' => 'Cây trưởng thành',
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
//                'name' => 'Budding',
                'name' => 'Ra hoa',
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
//                'name' => 'Flowering',
                'name' => 'Ra quả/trái',
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
//                'name' => 'Ripening',
                'name' => 'Thu hoạch',
                'note' => 'https://www.saferbrand.com/articles/plant-growth-stages',
                'created_at' => Carbon::now()->format('Y-m-d h:i:s'),
                'created_user' => 'Admin',
            ]
        );

    }
}
