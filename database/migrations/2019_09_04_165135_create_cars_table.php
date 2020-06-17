<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('RegNumber',255);
            $table->integer('MakerID')->unsigned();
            $table->integer('ModelID')->unsigned();
            $table->integer('FuelID')->unsigned()->nullable();
            $table->integer('CupeTypeID')->unsigned()->nullable();
            $table->integer('OfficeID')->unsigned()->nullable();
            $table->integer('ModelYear')->nullable();
            $table->decimal('CarBasePrice',10, 2)->default(0,00);
            $table->text('image', 16777215)->nullable();
            $table->integer('Doors')->nullable();
            $table->integer('Seats')->nullable();
            $table->integer('AC')->nullable();
            $table->integer('TankCapacity')->nullable();
            $table->string('TrunkVolume',255)->nullable();
            $table->string('Engine',255)->nullable();
            $table->string('GearType',255)->nullable();
            $table->string('HP',255)->nullable();
            $table->integer('isActive')->default(1);
            $table->timestamps();

            $table->foreign('MakerID')->references('id')->on('makers');
            $table->foreign('OfficeID')->references('id')->on('offices');
            $table->foreign('ModelID')->references('id')->on('carmodels');
            $table->foreign('FuelID')->references('id')->on('fueltypes');
            $table->foreign('CupeTypeID')->references('id')->on('cupetypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
