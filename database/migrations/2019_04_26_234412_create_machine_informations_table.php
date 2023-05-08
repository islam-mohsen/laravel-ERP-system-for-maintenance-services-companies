<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMachineInformationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('machine_informations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');
            $table->string('phone');
            $table->string('telephone');
            $table->string('contact_name');
            $table->tinyInteger('day_of_week');
            $table->time('open_time');
            $table->time('close_time');
            $table->integer('model_number');
            $table->bigInteger('machine_serial');
            $table->string('machine_place');
            $table->string('contract');
            $table->date('contract_start');
            $table->tinyInteger('billing_period');
            $table->integer('minimum_charge');
            $table->integer('free_copies');
            $table->integer('excess_copies');
            $table->string('notes');
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
        Schema::dropIfExists('machine_informations');
    }
}
