<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ToPaymentsChangeAddPaySum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_payments', function (Blueprint $table) {
            $table->Integer('paymentSum')->default(0);
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
           $table->dropColumn('paymentSum');
        });
    }
}
