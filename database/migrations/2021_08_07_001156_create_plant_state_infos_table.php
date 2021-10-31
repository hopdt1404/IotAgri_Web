<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantStateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plant_state_infos')) {
            Schema::create('plant_state_infos', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedTinyInteger('plant_state_id')->nullable();
                $table->unsignedBigInteger('plant_id')->nullable();
                $table->unsignedMediumInteger('growth_period_state')->nullable();
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
        Schema::dropIfExists('plant_state_infos');
    }
}
