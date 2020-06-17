<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancetranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('InsuranceTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('insurance_id')->unsigned();
            $table->string('insuranceName',255);
            $table->text('insuranceDescription')->nullable();
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['insurance_id','locale']);
            $table->foreign('insurance_id')->references('id')->on('Insurance')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('InsuranceTranslations');
    }
}
