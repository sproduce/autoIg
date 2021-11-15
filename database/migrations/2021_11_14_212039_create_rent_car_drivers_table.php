<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentCarDriversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_car_drivers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('surname');
            $table->string('name');
            $table->string('patronymic')->nullable();
            $table->boolean('male')->nullable();
            $table->date('birthday')->nullable();
            $table->string('nickname')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('regionId');
            $table->foreign('regionId')->references('id')->on('rent_car_driver_regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_car_drivers');
    }
}
