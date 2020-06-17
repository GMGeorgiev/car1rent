<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFueltypestranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FuelTypesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fuel_id')->unsigned();
            $table->string('Name',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['fuel_id','locale']);
            $table->foreign('fuel_id')->references('id')->on('fueltypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FuelTypesTranslation');
    }
}
