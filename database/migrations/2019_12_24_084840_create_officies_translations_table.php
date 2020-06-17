<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficiesTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('OfficiesTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('officeID')->unsigned();
            $table->string('officeName');
            $table->string('officeAddress');
            $table->string('locale')->index();

            $table->unique(['officeID','locale']);
            $table->foreign('officeID')->references('id')->on('offices')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('OfficiesTranslations');
    }
}
