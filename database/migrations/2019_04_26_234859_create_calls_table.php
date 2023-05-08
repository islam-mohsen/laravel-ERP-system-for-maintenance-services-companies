<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calls', function (Blueprint $table) {
            $table->increments('id');
            $table->date('call_date');
            $table->time('call_time');
            $table->string('call_type');
            $table->string('problem');

            $table->integer('machine_information_id')->unsigned();
            $table->foreign('machine_information_id')->references('id')->on('machine_informations');

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
        Schema::dropIfExists('calls');
    }
}
