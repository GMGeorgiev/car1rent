<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Booking', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('customer_id')->unsigned()->nullable()->default(null);
            $table->integer('company_id')->unsigned()->nullable()->default(null);
            $table->integer('user_id')->unsigned()->nullable()->default(null);
            $table->dateTime('from_date')->nullable()->default(null);
            $table->dateTime('to_date')->nullable()->default(null);
            $table->integer('car_id')->unsigned();
            $table->integer('status')->unsigned();
            $table->decimal('amount',10, 2)->default(0,00);
            $table->integer('pickup_loc')->unsigned();
            $table->integer('drop_loc')->unsigned();
            $table->integer('ins_code')->unsigned();
            $table->text('description')->nullable();
            $table->text('booking_file', 16777215)->nullable();
            $table->timestamps();

            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('Customers');
            $table->foreign('company_id')->references('id')->on('Companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Bookig');
    }
}
