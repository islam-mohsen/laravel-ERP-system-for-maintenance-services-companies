<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignReport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_reports', function (Blueprint $table) {

         $table->integer('engineers-id')->unsigned()->nullable();
         $table->foreign('engineers-id')->references('id')->on('engineers');

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
        $table->dropForeign('engineers-id');
      });
    }
}
