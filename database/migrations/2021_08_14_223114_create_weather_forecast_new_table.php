<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        if (!Schema::hasTable('weather_forecast')) {
//            Schema::create('weather_forecast', function (Blueprint $table) {
//                $table->bigIncrements('id');
//                $table->string('LocateID', 50)->nullable();
//                $table->timestamp('ForecastTime')->useCurrent()->nullable();
//                $table->bigInteger('EpochTime')->nullable();
//                $table->string('ForecastStatus', 50)->nullable();
//                $table->tinyInteger('IsDayLight')->nullable();
//                $table->float('Temperature')->nullable();
//                $table->float('WindSpeed')->nullable();
//                $table->float('RelativeHumidity')->nullable();
//                $table->tinyInteger('RainProbability')->nullable();
//                $table->tinyInteger('PrecipitationProbability')->nullable();
//                $table->float('RainValue')->nullable();
//                $table->tinyInteger('CloudCover')->nullable();
//                $table->timestamp('created_at')->useCurrent()->nullable();
//                $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
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
//        Schema::dropIfExists('weather_forecast');
    }
}
