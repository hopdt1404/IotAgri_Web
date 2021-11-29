<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Farms', function (Blueprint $table) {
            $table->string('name', 128)->nullable();
            $table->text('info')->nullable();
            $table->datetime('created_at')->useCurrent();
            $table->string('created_user', 128)->nullable();
            $table->dateTime('updated_at')->default(DB::raw('null on update CURRENT_TIMESTAMP'))->nullable();
            $table->string('updated_user', 128)->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Farms');
    }
}
