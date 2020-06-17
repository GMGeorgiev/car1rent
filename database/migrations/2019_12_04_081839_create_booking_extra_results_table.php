<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingExtraResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BookingExtraResults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('BookingID')->unsigned();
            $table->integer('RentalExtraID')->unsigned();

            $table->foreign('BookingID')->references('id')->on('Booking');
            $table->foreign('RentalExtraID')->references('id')->on('RentalExtras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BookingExtraResults');
    }
}
