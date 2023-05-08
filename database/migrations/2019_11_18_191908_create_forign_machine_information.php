<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForignMachineInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('machine_informations', function (Blueprint $table) {
            //
    $table->integer('engineer_id')->unsigned()->nullable();
    $table->foreign('engineer_id')->references('id')->on('engineers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('machine_informations', function (Blueprint $table) {
            //
            $table->dropForeign('engineer_id');

        });
    }
}
