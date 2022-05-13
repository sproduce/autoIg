<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_subjects', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('surname')->nullable();
            $table->string('name')->nullable();
            $table->string('patronymic')->nullable();
            $table->string('companyName')->nullable();
            $table->string('nickname')->nullable();
            $table->boolean('male')->nullable();
            $table->date('birthday')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedBigInteger('pid')->nullable();
            $table->unsignedBigInteger('payAccountId')->nullable();
            $table->foreign('payAccountId')->references('id')->on('pay_accounts');
            $table->unsignedBigInteger('regionId')->nullable();
            $table->boolean('individual')->nullable();
            $table->boolean('client')->nullable();
            $table->boolean('carOwner')->nullable();
            $table->boolean('accessible')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_subjects');
    }
}
