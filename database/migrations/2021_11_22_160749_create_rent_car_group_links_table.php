<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCarGroupLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_car_group_links', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('groupId');
            $table->dateTime('start');
            $table->dateTime('finish')->nullable();

            $table->foreign('carId')->references('id')->on('car_configurations');
            $table->foreign('groupId')->references('id')->on('rent_car_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_car_group_links');
    }
}
