<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('payOperationTypeId')->nullable()->change();
            $table->foreign('payOperationTypeId')->references('id')->on('pay_operation_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('payOperationTypeId')->nullable(false)->change();
        });
    }
}
