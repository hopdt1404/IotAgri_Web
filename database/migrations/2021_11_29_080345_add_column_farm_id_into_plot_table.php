<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnFarmIdIntoPlotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Devices', function (Blueprint $table) {
            $table->integer('FarmID')->nullable()->after('Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Devices', function (Blueprint $table)
        {
            if (Schema::hasColumn('Devices', 'FarmID'))
            {
                $table->dropColumn('FarmID');
            }
        });
    }
}
