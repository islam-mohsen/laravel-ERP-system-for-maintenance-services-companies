<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveSparePartsFromServiceReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_reports', function (Blueprint $table) {
            //
             $table->dropColumn('spare_parts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_reports', function (Blueprint $table) {
            //
            $table->string('spare_parts');
        });
    }
}
