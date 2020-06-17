<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymenttypetranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentTypeTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('PaymentTypeID')->unsigned();
            $table->string('PaymentTypeName',255);
            $table->text('PaymentTypeDescription')->nullable();
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['PaymentTypeID','locale']);
            $table->foreign('PaymentTypeID')->references('id')->on('PaymentTypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PaymentTypeTranslations');
    }
}
