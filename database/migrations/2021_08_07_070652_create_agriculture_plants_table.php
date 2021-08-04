<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgriculturePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('agriculture_plants')) {
            Schema::create('agriculture_plants', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('plant_id')->nullable();
                $table->unsignedTinyInteger('plant_state_id')->nullable();
                $table->unsignedBigInteger('FarmID')->nullable();
                $table->unsignedBigInteger('user_id')->nullable();
                $table->unsignedMediumInteger('growth_period')->nullable();
                $table->float('temperature')->nullable()->comment('Nhiet do');
                $table->float('moisture')->nullable()->comment('Do am');
                $table->text('light')->nullable()->comment('cuong do anh sang');
                $table->text('note')->nullable();
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
        Schema::dropIfExists('agriculture_plants');
    }
}
