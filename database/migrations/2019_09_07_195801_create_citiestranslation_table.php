<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiestranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CitiesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('city_id')->unsigned();
            $table->string('DefaultName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['city_id','locale']);
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CitiesTranslation');
    }
}
