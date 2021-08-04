<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plant_types')) {
            Schema::create('plant_types', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('name', 50)->nullable();
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
        Schema::dropIfExists('plant_types');
    }
}
