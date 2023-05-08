<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomOfPrdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('room_of_prds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('part_num_id')->unsigned();
            $table->integer('quantity');
            $table->integer('room_id')->unsigned();
            $table->softDeletes('deleted_at');

            $table->foreign('part_num_id')->references('id')->on('products');
            $table->foreign('room_id')->references('id')->on('rooms');


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
        Schema::dropIfExists('room_of_prds');
    }
}
