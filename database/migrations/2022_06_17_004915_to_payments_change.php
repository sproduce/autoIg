<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ToPaymentsChange extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('subjectIdFrom')->nullable();
            $table->unsignedBigInteger('subjectIdTo')->nullable();
            $table->dateTime('payUp')->nullable();
            $table->foreign('subjectIdTo')->references('id')->on('rent_subjects');
            $table->foreign('subjectIdFrom')->references('id')->on('rent_subjects');
            $table->foreign('paymentId')->references('id')->on('rent_payments');
            $table->dropColumn('carId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('to_payments', function (Blueprint $table) {

        });
    }
}
