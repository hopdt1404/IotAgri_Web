<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnPlantIdIntoPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Plots', function (Blueprint $table) {
            $table->integer('plant_id')->nullable()->after('FarmID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Plots', function (Blueprint $table)
        {
            if (Schema::hasColumn('Plots', 'plant_id'))
            {
                $table->dropColumn('plant_id');
            }
        });
    }
}
