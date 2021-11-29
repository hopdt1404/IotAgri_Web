<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->updateOrInsert(
            [
                'id' => 1,
            ],
            [
                'name' => 'admin',
                'email' => 'admin@iotagriculture.com',
                'password' => bcrypt('123456'),
                'group_user_id' => 1,
            ]
        );
        DB::table('Users')->updateOrInsert(
            [
                'UserID' => 1,
            ],
            [
                'UserName' => 'admin',
                'Email' => 'admin@iotagriculture.com',
                'UPassword' => md5('123456')
            ]
        );

    }
}
