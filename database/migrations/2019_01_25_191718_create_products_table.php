<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_name_id')->unsigned();
            $table->integer('dec_id')->unsigned();
            $table->string('part_num')->unique();
            $table->string('part_num_hp')->nullable();
            $table->integer('prd_mod_id')->unsigned();
            $table->integer('prd_type_id')->unsigned();
            $table->integer('cost')->unsigned();
            $table->integer('min');
            $table->string('img');
            $table->softDeletes('deleted_at');

            $table->foreign('brand_name_id')->references('id')->on('brands');
            $table->foreign('dec_id')->references('id')->on('descriptions');
            $table->foreign('prd_mod_id')->references('id')->on('product_models');
            $table->foreign('prd_type_id')->references('id')->on('product_types');

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
        Schema::dropIfExists('products');
    }
}
