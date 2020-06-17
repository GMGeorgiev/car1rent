<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Discounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('start_date')->nullable()->default(null);
            $table->dateTime('end_date')->nullable()->default(null);
            $table->decimal('DiscountPrice',10, 2)->default(0,00);
            $table->text('Description')->nullable();
            $table->integer('isActive')->default(1);
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
        Schema::dropIfExists('Discounts');
    }
}
