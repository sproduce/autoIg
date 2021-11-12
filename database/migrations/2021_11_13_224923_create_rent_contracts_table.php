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
            $table->unsignedBigInteger('carDriverId')->nullable();
            $table->unsignedBigInteger('StatusId');
            $table->unsignedBigInteger('TypeId');

            $table->dateTime('start');
            $table->dateTime('finish')->nullable();
            $table->dateTime('finishFact')->nullable();
            $table->string('number');
            $table->unsignedInteger('balance')->nullable();
            $table->string('comment')->nullable();

            $table->foreign('TypeId')->references('id')->on('rent_contract_types');
            $table->foreign('StatusId')->references('id')->on('rent_contract_statuses');

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
