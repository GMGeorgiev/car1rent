<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarextrastranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CarExtrasTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('extra_id')->unsigned();
            $table->string('DefaultName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['extra_id','locale']);
            $table->foreign('extra_id')->references('id')->on('carextras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CarExtrasTranslation');
    }
}
