<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriestranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CountriesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('country_id')->unsigned();
            $table->string('countryName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['country_id','locale']);
            $table->foreign('country_id')->references('id')->on('Countries')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CountriesTranslation');
    }
}
