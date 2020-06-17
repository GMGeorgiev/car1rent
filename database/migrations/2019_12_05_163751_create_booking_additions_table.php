<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingAdditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BookingAdditions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bookingID')->unique()->unsigned();
            $table->string('firstName');
            $table->string('lastName')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->string('phone')->nullable()->default(null);
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('countryID')->unsigned()->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->dateTime('birth_date')->nullable()->default(null);
            $table->string('TakeAddress')->nullable()->default(null);
            $table->string('RetAddress')->nullable()->default(null);
            $table->text('message')->nullable()->default(null);
            $table->integer('paymentType')->unsigned()->nullable()->default(null);
            $table->timestamps();

            $table->foreign('bookingID')->references('id')->on('Booking');
            $table->foreign('countryID')->references('id')->on('Countries');
            $table->foreign('paymentType')->references('id')->on('PaymentTypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BookingAdditions');
    }
}
