<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlotTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('PlotTypes')->updateOrInsert(
            [
                'PlotTypeID' => 1,
            ],
            [
                'PlotType' => 'Default',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
    }
}
