<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupUserIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedTinyInteger('group_user_id')->default(0)
                ->after('remember_token')->comment('0: User, 1: Admin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'group_user_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('group_user_id');
            });
        }

    }
}
