<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountstranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DiscountsTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('discount_id')->unsigned();
            $table->string('DiscountName',255);
            $table->text('DiscountDescriptions')->nullable();
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['discount_id','locale']);
            $table->foreign('discount_id')->references('id')->on('Discounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('DiscountsTranslation');
    }
}
