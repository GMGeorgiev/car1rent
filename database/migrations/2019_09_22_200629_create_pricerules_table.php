<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePricerulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PriceRules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('price_id')->unsigned();
            $table->dateTime('start_date')->nullable()->default(null);
            $table->dateTime('end_date')->nullable()->default(null);
            $table->decimal('RulePrice',10, 2)->default(0,00);
            $table->text('Description')->nullable();
            $table->integer('car_id')->unsigned()->nullable()->default(null);
            $table->integer('model_id')->unsigned()->nullable()->default(null);
            $table->integer('gear_type')->unsigned()->nullable()->default(null);
            $table->integer('fuel_id')->unsigned()->nullable()->default(null);
            $table->integer('sipp_id')->unsigned()->nullable()->default(null);
            $table->integer('fleet_id')->unsigned()->nullable()->default(null);
            $table->integer('maker_id')->unsigned()->nullable()->default(null);
            $table->integer('coupe_id')->unsigned()->nullable()->default(null);
            $table->integer('discount_id')->unsigned()->nullable()->default(null);

            $table->integer('isActive')->default(1);
            $table->timestamps();



            $table->unique(['price_id']);
            $table->foreign('discount_id')->references('id')->on('Discounts');
            $table->foreign('coupe_id')->references('id')->on('coupetypes');
            $table->foreign('maker_id')->references('id')->on('makers');
            $table->foreign('fleet_id')->references('id')->on('fleettypes');
            $table->foreign('sipp_id')->references('id')->on('SIPPcodes');
            $table->foreign('fuel_id')->references('id')->on('fueltypes');
            $table->foreign('model_id')->references('id')->on('carmodels');
            $table->foreign('car_id')->references('id')->on('cars');
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
        Schema::dropIfExists('PriceRules');
    }
}
