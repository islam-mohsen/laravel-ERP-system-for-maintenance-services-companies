<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesFromsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_froms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('part_num_id')->unsigned();
            $table->integer('quantity');
            $table->integer('cost');
            $table->integer('sale_id')->unsigned();

            $table->foreign('part_num_id')->references('id')->on('products');
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->softDeletes('deleted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_froms');
    }
}
