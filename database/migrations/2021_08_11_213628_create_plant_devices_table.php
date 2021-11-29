<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        if (!Schema::hasTable('plant_devices')) {
//            Schema::create('plant_devices', function (Blueprint $table) {
//                $table->bigIncrements('id');
//                $table->unsignedBigInteger('plant_id')->nullable();
//                $table->unsignedBigInteger('DeviceID')->nullable();
//                $table->unsignedBigInteger('FarmID')->nullable();
//                $table->tinyInteger('status')->nullable();
//                $table->datetime('created_at')->useCurrent();
//                $table->string('created_user', 128)->nullable();
//                $table->dateTime('updated_at')->default(DB::raw('null on update CURRENT_TIMESTAMP'))->nullable();
//                $table->string('updated_user', 128)->nullable();
//            });
//        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        Schema::dropIfExists('plant_devices');
    }
}
