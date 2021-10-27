<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarGenerationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_generations', function (Blueprint $table) {
            //$table->charset = 'utf8';
            //$table->collation = 'utf8_general_ci';
            $table->id();
            $table->uuid('uuid');
            $table->unsignedBigInteger('modelId');
            $table->foreign('modelId')->references('id')->on('car_models');
            $table->string('name');
            $table->date('start');
            $table->date('finish');
            $table->softDeletes();
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
        Schema::dropIfExists('car_generations');
    }
}
