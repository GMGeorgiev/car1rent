<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingInsuranceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BookingInsuranceResults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('BookingID')->unsigned();
            $table->integer('InsuranceID')->unsigned();

            $table->foreign('BookingID')->references('id')->on('Booking');
            $table->foreign('InsuranceID')->references('id')->on('Insurance');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BookingInsuranceResults');
    }
}
