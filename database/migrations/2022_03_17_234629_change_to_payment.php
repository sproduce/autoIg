<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToPayment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_payments', function (Blueprint $table) {
            $table->integer('sum')->change();
            $table->unsignedBigInteger('contractId')->nullable()->change();
            $table->unsignedBigInteger('carId')->nullable();
            $table->unsignedBigInteger('paymentId')->nullable();
            $table->unsignedBigInteger('pId')->nullable();
            $table->dropColumn(['isPay']);

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
            $table->dropColumn(['carId','paymentId','pId']);
        });
    }
}
