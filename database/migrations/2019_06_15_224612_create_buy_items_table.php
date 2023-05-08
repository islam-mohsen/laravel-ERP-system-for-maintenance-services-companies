<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->integer('cost');

            $table->integer('part_num_id')->unsigned();
            $table->foreign('part_num_id')->references('id')->on('products');

            $table->integer('buy_id')->unsigned();
            $table->foreign('buy_id')->references('id')->on('buy_products');

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
        Schema::dropIfExists('buy_items');
    }
}
