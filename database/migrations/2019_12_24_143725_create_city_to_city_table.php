<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCityToCityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CarCityToCity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cityFromID')->unsigned();
            $table->integer('cityToID')->unsigned();
            $table->decimal('TransferPrice',10, 2)->default(0,00);
            $table->integer('isActive')->default(1);
            $table->timestamps();

            $table->foreign('cityFromID')->references('id')->on('cities');
            $table->foreign('cityToID')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CityToCity');
    }
}
