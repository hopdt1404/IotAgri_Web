<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSensingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('Sensing')) {
            Schema::create('Sensing', function (Blueprint $table) {
                $table->unsignedBigInteger('SensingID')->autoIncrement();
                $table->unsignedBigInteger('DeviceID')->nullable();
                $table->unsignedBigInteger('PlotID')->nullable();
                $table->float('SoilMoisture')->nullable();
                $table->float('Humidity')->nullable();
                $table->float('Temperature')->nullable();
                $table->integer('LightLevel')->nullable();
                $table->dateTime('TimeOfMeasurement')->nullable();
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
        Schema::dropIfExists('Sensing');
    }
}
