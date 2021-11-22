<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('dateTime');
            $table->unsignedBigInteger('payAccountId');
            $table->unsignedBigInteger('payOperationTypeId');
            $table->mediumInteger('payment');
            $table->mediumInteger('balance');
            $table->string('name');
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('carGroupId');
            $table->boolean('finished');
            $table->unsignedBigInteger('pId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_payments');
    }
}
