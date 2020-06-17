<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMyCompanyTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MyCompanyTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('companyID')->unsigned();
            $table->string('companyName');
            $table->string('companyAddress');
            $table->string('companyMOL');
            $table->string('locale')->index();

            $table->unique(['companyID','locale']);
            $table->foreign('companyID')->references('id')->on('MyCompany')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('MyCompanyTranslations');
    }
}
