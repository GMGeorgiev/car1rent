<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName');
            $table->integer('countryID')->unique()->unsigned();
            $table->string('companyAddress');
            $table->string('companyMOL');
            $table->string('companyPhone');
            $table->string('companyEmail');
            $table->integer('isLowCost')->default(0);
            $table->integer('isActive')->default(1);
            $table->timestamps();
            $table->foreign('countryID')->references('id')->on('Countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Companies');
    }
}
