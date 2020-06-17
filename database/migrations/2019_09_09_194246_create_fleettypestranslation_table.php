<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFleettypestranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FleetTypesTranslation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('fleetType_id')->unsigned();
            $table->string('DefaultName',255);
            $table->string('locale')->index();
            $table->integer('isActive')->default(1);

            $table->unique(['fleetType_id','locale']);
            $table->foreign('fleetType_id')->references('id')->on('fleettypes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('FleetTypesTranslation');
    }
}
