<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('plants')) {
            Schema::create('plants', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name', 50)->nullable();
                $table->unsignedTinyInteger('plant_type_id')->nullable();
                $table->string('growth_period', 50)->nullable()->comment('Thoi gian sinh truong');
                $table->text('planting_time')->nullable()->comment('thoi gian gieo trong');
                $table->string('plant_density', 255)->nullable()->comment('mat do cay trong');
                $table->string('width_bed', 255)->nullable()->comment('Do rong hang');
                $table->string('height_bed', 255)->nullable()->comment('do cao cua hang');
                $table->string('row_spacing', 255)->nullable()->comment('khoa cach giua cac hang');
                $table->string('tree_spacing', 255)->nullable()->comment('khoang cach giua cac cay');
                $table->unsignedTinyInteger('soil_type_id')->nullable()->comment('Dat canh tac');
                $table->text('info')->nullable()->comment('Thong tin khac');
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
        Schema::dropIfExists('plants');
    }
}
