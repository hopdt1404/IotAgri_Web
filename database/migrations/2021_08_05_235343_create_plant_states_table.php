<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plant_states')) {
            Schema::create('plant_states', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('name', 50)->nullable();
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
        Schema::dropIfExists('plant_states');
    }
}
