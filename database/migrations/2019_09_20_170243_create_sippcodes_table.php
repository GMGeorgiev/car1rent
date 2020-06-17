<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSippcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('SIPPcodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Code',10);
            $table->integer('Position');
            $table->string('Description',10);
            $table->integer('isActive')->default(1);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('SIPPcodes');
    }
}
