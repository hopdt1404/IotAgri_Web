<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LocateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Get all location City in VN
        $string = file_get_contents("/home/hopdt/Documents/uet/Web/example_project_laravel_vuejs/laravel-vue-spa/database/init/server/city.list.json");
        $json_a = json_decode($string,true);
        foreach ($json_a as $key => $value) {
            if ($value['country'] == 'VN') {
                $id = $value['id'];
                $name = $value['name'];
                DB::table('Locates')->updateOrInsert(
                    [
                        'LocateID' => $id,
                    ],
                    [
                        'LocateName' => $name,
                        'created_at' => Carbon::now(),
                        'created_user' => 'Admin',
                    ]
                );
            }
        }
    }
}
