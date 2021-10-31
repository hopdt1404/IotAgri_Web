<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherForecastAtATimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('WeatherForecastAtATimes')) {
            Schema::create('WeatherForecastAtATimes', function (Blueprint $table) {
                $table->unsignedBigInteger('WeatherForecastID')->autoIncrement();
                $table->timestamp('ForecastTime')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
                $table->bigInteger('EpochTime')->nullable();
                $table->string('ForecastStatus', 50)->nullable();
                $table->tinyInteger('IsDayLight')->nullable();
                $table->float('Temperature')->nullable();
                $table->float('WindSpeed')->nullable();
                $table->float('RelativeHumidity')->nullable();
                $table->tinyInteger('RainProbability')->nullable();
                $table->tinyInteger('PrecipitationProbability')->nullable();
                $table->float('RainValue')->nullable();
                $table->tinyInteger('CloudCover')->nullable();
                $table->timestamp('created_at')->useCurrent()->nullable();
                $table->timestamp('updated_at')->useCurrentOnUpdate()->nullable();
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
        Schema::dropIfExists('WeatherForecastAtATimes');
    }
}
