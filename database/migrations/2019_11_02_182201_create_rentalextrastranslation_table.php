<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalextrastranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RentalExtrasTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('extra_id')->unsigned();
            $table->string('RentExtraName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['extra_id','locale']);
            $table->foreign('extra_id')->references('id')->on('RentalExtras')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('RentalExtrasTranslation');
    }
}
