<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Coupons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('text',255);
            $table->decimal('couponPrice',10, 2)->default(0,00);
            $table->dateTime('start_date')->nullable()->default(null);
            $table->dateTime('end_date')->nullable()->default(null);
            $table->integer('once')->nullable()->default(null);
            $table->integer('percent')->nullable()->default(null);
            $table->text('description')->nullable();
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
        Schema::dropIfExists('Coupons');
    }
}
