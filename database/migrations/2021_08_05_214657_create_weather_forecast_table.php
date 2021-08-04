<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('WeatherForecasts')) {
            Schema::create('WeatherForecasts', function (Blueprint $table) {
                $table->unsignedBigInteger('WeatherForecastID')->autoIncrement();
                $table->string('LocateID', 50);
                $table->timestamp('CurrentTime')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
        Schema::dropIfExists('WeatherForecasts');
    }
}
