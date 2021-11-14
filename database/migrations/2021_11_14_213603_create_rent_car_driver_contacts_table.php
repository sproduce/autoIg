<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCarDriverContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_car_driver_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('phone');
            $table->unsignedBigInteger('driverId');
            $table->foreign('driverId')->references('id')->on('rent_car_drivers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_car_driver_contacts');
    }
}
