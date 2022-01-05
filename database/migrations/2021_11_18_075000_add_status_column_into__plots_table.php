<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusColumnIntoPlotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Plots', function (Blueprint $table) {
            $table->integer('status')->default(0)->after('PlotTypeID')
                ->comment('-1: Deactivate, 0: Init, 1: Activate');
            $table->string('name', 128)->nullable()->after('PlotID');
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
            if (Schema::hasColumn('Plots', 'status'))
            {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('Plots', 'name'))
            {
                $table->dropColumn('name');
            }
        });

    }
}
