<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarmodelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carmodels', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ModelName',255);
            $table->integer('MakerID')->unsigned();
            $table->integer('FleetTypeID')->unsigned();
            $table->string('ModelYear',255)->nullable();
            $table->text('model_image_url', 16777215)->nullable();
            $table->decimal('ModelBasePrice',10, 2)->default(0,00);
            $table->integer('isActive')->default(1);
            $table->timestamps();

            $table->foreign('MakerID')->references('id')->on('makers');
            $table->foreign('FleetTypeID')->references('id')->on('fleettypes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carmodels');
    }
}
