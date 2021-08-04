<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Locates')->updateOrInsert(
            [
                'LocateID' => 353412,
            ],
            [
                'LocateName' => 'Ha Noi',
                'created_at' => Carbon::now(),
                'created_user' => 'Admin',
            ]
        );
    }
}
