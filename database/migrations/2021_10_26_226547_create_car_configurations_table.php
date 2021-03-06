<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_configurations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid');
            $table->unsignedBigInteger('generationId');
            $table->foreign('generationId')->references('id')->on('car_generations');

            $table->unsignedBigInteger('typeId');
            $table->foreign('typeId')->references('id')->on('car_types');


            $table->unsignedBigInteger('ownerId');
            $table->foreign('ownerId')->references('id')->on('car_owners');

            $table->string('displacement');
            $table->string('hp');
            $table->string('regNumber');
            $table->string('vin');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_configurations');
    }
}
