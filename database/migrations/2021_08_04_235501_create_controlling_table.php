<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControllingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Controlling')) {
            Schema::create('Controlling', function (Blueprint $table) {
                $table->unsignedBigInteger('ControllingID')->autoIncrement();
                $table->unsignedBigInteger('DeviceID')->nullable();
                $table->unsignedBigInteger('PlotID')->nullable();
                $table->float('AmountOfWater')->nullable();
                $table->integer('WateringDuration')->nullable();
                $table->dateTime('TimeOfControl')->nullable();
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
        Schema::dropIfExists('Controlling');
    }
}
