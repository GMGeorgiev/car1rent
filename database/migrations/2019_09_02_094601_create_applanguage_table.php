<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AppLanguage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Name',50)->unique();
            $table->string('iso',50)->unique();
            $table->integer('is_primary')->unsigned()->default(0);
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
        Schema::dropIfExists('AppLanguage');
    }
}
