<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_contracts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('driverId')->nullable();
            $table->unsignedBigInteger('statusId');
            $table->unsignedBigInteger('typeId');
            $table->unsignedBigInteger('tariffId');

            $table->dateTime('start');
            $table->dateTime('finish')->nullable();
            $table->dateTime('finishFact')->nullable();
            $table->string('number');
            $table->unsignedInteger('balance')->nullable();
            $table->unsignedInteger('deposit')->nullable();
            $table->unsignedBigInteger('carId');
            $table->string('comment')->nullable();


            $table->foreign('carId')->references('id')->on('car_configurations');
            $table->foreign('typeId')->references('id')->on('rent_contract_types');
            $table->foreign('statusId')->references('id')->on('rent_contract_statuses');
            $table->foreign('tariffId')->references('id')->on('rent_contract_tariffs');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_contracts');
    }
}
