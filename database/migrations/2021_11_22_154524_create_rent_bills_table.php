<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_bills', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->dateTime('dateTime');
            $table->unsignedBigInteger('payAccountId')->nullable();
            $table->unsignedBigInteger('payOperationTypeId');
            $table->mediumInteger('payment');
            $table->mediumInteger('balance');
            $table->unsignedBigInteger('carId');
            $table->unsignedBigInteger('carGroupId');
            $table->date('endPaymentDate');
            $table->boolean('finished');
            $table->unsignedBigInteger('rentPaymentId');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_bills');
    }
}
