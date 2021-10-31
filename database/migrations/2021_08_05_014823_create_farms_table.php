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
        if (!Schema::hasTable('Farms')) {
            Schema::create('Farms', function (Blueprint $table) {
                $table->unsignedBigInteger('FarmID')->autoIncrement();
                $table->string('LocateID', 50)->nullable();
                $table->string('name', 128)->nullable();
                $table->double('Area')->nullable();
                $table->unsignedSmallInteger('FarmTypeID')->nullable();
                $table->smallInteger('Status')->nullable();
                $table->text('info')->nullable();
                $table->unsignedBigInteger('UserID')->nullable();
                $table->datetime('created_at')->useCurrent();
                $table->string('created_user', 128)->nullable();
                $table->dateTime('updated_at')->default(DB::raw('null on update CURRENT_TIMESTAMP'))->nullable();
                $table->string('updated_user', 128)->nullable();
            });
        }

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
