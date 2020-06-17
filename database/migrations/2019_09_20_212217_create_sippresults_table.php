<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSippresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SIPPcodeResults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('SippID')->unsigned();
            $table->integer('CarID')->unsigned();
            $table->timestamps();

            $table->foreign('CarID')->references('id')->on('cars');
            $table->foreign('SippID')->references('id')->on('SIPPcodes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SIPPcodeResults');
    }
}
