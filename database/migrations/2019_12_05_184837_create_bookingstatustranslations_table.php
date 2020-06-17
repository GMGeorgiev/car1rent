<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingstatustranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('BookingStatusTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('BookingStatusID')->unsigned();
            $table->string('BookingStatusName',255);
            $table->string('locale')->index();

            $table->unique(['BookingStatusID','locale']);
            $table->foreign('BookingStatusID')->references('id')->on('BookingStatuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('BookingStatusTranslations');
    }
}
