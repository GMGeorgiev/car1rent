<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMycompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MyCompany', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('countryID')->unique()->unsigned();
            $table->string('companyPhone');
            $table->string('companyEmail');
            $table->timestamp("beginWork")->nullable()->default(null);
            $table->timestamp("endWork")->nullable()->default(null);
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
        Schema::dropIfExists('PMyCompany');
    }
}
