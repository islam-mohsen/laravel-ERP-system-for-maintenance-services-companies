<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visite_date');
            $table->bigInteger('meter_reading');
            $table->time('work_start');
            $table->time('work_end');
            $table->date('cust_time');
            $table->date('store_time');
            $table->boolean('job_complete');
            $table->string('comments');
            $table->string('spare_parts');

            $table->integer('call_id')->unsigned();
            $table->foreign('call_id')->references('id')->on('calls');


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
        Schema::dropIfExists('service_reports');
    }
}
