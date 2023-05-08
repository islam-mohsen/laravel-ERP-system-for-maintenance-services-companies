<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_number');
            $table->integer('supplier_id')->unsigned();
            $table->string('name_emp');
            $table->integer('tax');
            $table->integer('check_num');
            $table->integer('check');
            $table->date('date');
            $table->softDeletes('deleted_at');

            $table->foreign('supplier_id')->references('id')->on('suppliers');

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
        Schema::dropIfExists('buy_products');
    }
}
