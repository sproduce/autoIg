<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePayAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->string('nickName');
            $table->unsignedBigInteger('bunkNameId');

            $table->string('cardNumber');
            $table->string('accountNumber');
            $table->string('bik');
            $table->string('corrAccount');
            $table->string('number');
            $table->string('currency');
            $table->unsignedBigInteger('payAccountTypeId');
            $table->dateTime('start');
            $table->dateTime('finish');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_accounts');
    }
}
