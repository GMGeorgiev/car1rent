<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCopetypestranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CupeTypesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('cupeType_id')->unsigned();
            $table->string('DefaultName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['cupeType_id','locale']);
            $table->foreign('cupeType_id')->references('id')->on('cupetypes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CupeTypesTranslation');
    }
}
