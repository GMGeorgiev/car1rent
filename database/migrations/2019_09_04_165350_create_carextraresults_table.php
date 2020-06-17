<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarextraresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carextraresults', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('CarID')->unsigned();
            $table->integer('CarExtraID')->unsigned();
            $table->timestamps();

            $table->foreign('CarID')->references('id')->on('cars');
            $table->foreign('CarExtraID')->references('id')->on('carextras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carextraresults');
    }
}
