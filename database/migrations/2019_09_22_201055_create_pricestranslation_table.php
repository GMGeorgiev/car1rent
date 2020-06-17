<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricestranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PricesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price_id')->unsigned();
            $table->string('Name',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['price_id','locale']);
            $table->foreign('price_id')->references('id')->on('Prices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PricesTranslation');
    }
}
