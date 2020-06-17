<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('OfficeName',255);
            $table->integer('CountryID')->unsigned();
            $table->integer('CityID')->unsigned();
            $table->string('Address',255)->nullable();
            $table->decimal('lat',11, 8)->nullable();
            $table->decimal('lon',11, 8)->nullable();
            $table->string('Phone',255)->nullable();
            $table->string('MobilePhone',255)->nullable();
            $table->string('Fax',255)->nullable();
            $table->string('email')->nullable();
            $table->text('office_image_url', 16777215)->nullable();
            $table->integer('isActive')->default(1);
            $table->timestamps();

            $table->foreign('CountryID')->references('id')->on('countries');
            $table->foreign('CityID')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offices');
    }
}
