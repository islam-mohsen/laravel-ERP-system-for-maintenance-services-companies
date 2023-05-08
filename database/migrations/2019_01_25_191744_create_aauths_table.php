<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAauthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aauths', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('part_num')->unsigned();
            $table->integer('auth');
            $table->softDeletes('deleted_at');

            $table->foreign('part_num')->references('id')->on('products');

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
        Schema::dropIfExists('aauths');
    }
}
