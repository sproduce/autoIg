<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_sheets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('contractId')->nullable();
            $table->unsignedBigInteger('eventId')->nullable();
            $table->string('color');
            $table->dateTime('dateTime');
            $table->string('sum');
            $table->string('comment');
            $table->foreign('carId')->references('id')->on('car_configurations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_sheets');
    }
}
