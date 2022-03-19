<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToPaymentTimeSheetNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('to_payments', function (Blueprint $table) {
            $table->unsignedBigInteger('timeSheetId')->nullable()->change();
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
            $table->unsignedBigInteger('timeSheetId')->nullable(false)->change();
        });
    }
}
