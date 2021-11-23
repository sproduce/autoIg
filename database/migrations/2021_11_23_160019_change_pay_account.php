<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePayAccount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pay_accounts', function (Blueprint $table) {
            $table->string('nickName')->nullable()->change();
            $table->string('cardNumber')->nullable()->change();
            $table->string('accountNumber')->nullable()->change();
            $table->string('bik')->nullable()->change();
            $table->string('corrAccount')->nullable()->change();
            $table->string('number')->nullable()->change();
            $table->string('currency')->nullable()->change();
            $table->dateTime('finish')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
