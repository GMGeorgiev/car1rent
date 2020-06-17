<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymenttypestatustranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('PaymentStatusTranslations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('PaymentStatusID')->unsigned();
            $table->string('PaymentStatusName',255);
            $table->string('locale')->index();

            $table->unique(['PaymentStatusID','locale']);
            $table->foreign('PaymentStatusID')->references('id')->on('PaymentStatuses')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PaymentStatusTranslations');
    }
}
