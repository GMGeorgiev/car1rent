<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CouponResults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('couponID')->unsigned();
            $table->integer('bookingID')->unsigned();
            $table->integer('customerID')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->unique(['couponID']);
            $table->foreign('couponID')->references('id')->on('cars');
            $table->foreign('bookingID')->references('id')->on('Booking');
            $table->foreign('customerID')->references('id')->on('Customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CouponResults');
    }
}
