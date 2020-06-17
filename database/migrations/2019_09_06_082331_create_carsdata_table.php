<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsdataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carsdata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('CarID')->unsigned();
            $table->integer('ModelID')->unsigned();
            $table->integer('CupeTypeID')->unsigned();
            $table->integer('FuelTypeID')->unsigned();
            $table->string('CarYear',50)->nullable();
            $table->integer('Seats')->nullable();
            $table->integer('FuelTank')->nullable();
            $table->integer('HP')->nullable();
            $table->integer('Trunk')->nullable();
            $table->integer('EngineVolume')->nullable();
            $table->string('Doors')->nullable();
            $table->integer('GearboxType')->nullable();
            $table->integer('AC')->default(1);
            $table->timestamps();

            $table->foreign('CarID')->references('id')->on('cars');
            $table->foreign('ModelID')->references('id')->on('carmodels');
            $table->foreign('CupeTypeID')->references('id')->on('cupetypes');
            $table->foreign('FuelTypeID')->references('id')->on('fueltypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carsdata');
    }
}
