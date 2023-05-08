<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForignSales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
            $table->integer('customers_id')->unsigned()->nullable();
            $table->foreign('customers_id')->references('id')->on('customers');
            $table->integer('sales_mens_id')->unsigned()->nullable();
            $table->foreign('sales_mens_id')->references('id')->on('sales_mens');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            //
            $table->dropForeign('customers_id');
            $table->dropForeign('sales_mens_id');

        });
    }
}
