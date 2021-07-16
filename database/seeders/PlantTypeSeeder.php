<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlantTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 1,
            ],
            [
                'name' => 'Annuals',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 2,
            ],
            [
                'name' => 'Bulbs',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 3,
            ],
            [
                'name' => 'Cactus - Succulents',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 4,
            ],
            [
                'name' => 'Climbers',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 5,
            ],
            [
                'name' => 'Conifers',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 6,
            ],
            [
                'name' => 'Ferns',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 7,
            ],
            [
                'name' => 'Fruit',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 8,
            ],
            [
                'name' => 'Herbs',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 9,
            ],
            [
                'name' => 'Ornamental Grasses',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 10,
            ],
            [
                'name' => 'Perennials',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 11,
            ],
            [
                'name' => 'Roses',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 12,
            ],
            [
                'name' => 'Shrubs',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 13,
            ],
            [
                'name' => 'Trees',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 14,
            ],
            [
                'name' => 'Palms - Cycads',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 15,
            ],
            [
                'name' => 'Bamboos',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 16,
            ],
            [
                'name' => 'Aquatic Plants',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );

        DB::table('plant_types')->updateOrInsert(
            [
                'id' => 17,
            ],
            [
                'name' => 'Orchids',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );

    }
}
