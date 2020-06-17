<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRentalextrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('RentalExtras', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('RentExtraPrice',10, 2)->default(0,00);
            $table->text('rental_extra_image', 16777215)->nullable();
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
        Schema::dropIfExists('RentalExtras');
    }
}
