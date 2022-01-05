<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmPlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('farm_plants')) {
            Schema::create('farm_plants', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('PlotID')->nullable();
                $table->unsignedBigInteger('plant_id')->nullable();
                $table->date('start_time_season')->nullable()->comment('thoi gian bat dau vu mua');
                $table->date('end_time_season')->nullable()->comment('Thoi gian ket thuc vu mua');
                $table->unsignedTinyInteger('current_plant_state')->nullable()->comment('Trang thai sinh truong hien tai');
                $table->unsignedSmallInteger('current_growth_day')->nullable()->comment('so ngay sinh truong o trang thai hien tai');
                $table->unsignedMediumInteger('total_growth_day')->nullable()->comment('Tong so ngay da sinh truong tu khi gieo trong');
                $table->tinyInteger('status')->nullable()->comment('-1: Deactivate, 0: Init, 1: Activate, 2: End_Season');
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
        Schema::dropIfExists('farm_plants');
    }
}
