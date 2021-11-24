<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCommRentPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_payments', function (Blueprint $table) {
            $table->integer('comm')->nullable();
            $table->integer('balance')->nullable()->change();
            $table->string('name')->nullable()->change();
            $table->unsignedBigInteger('carId')->nullable()->change();
            $table->unsignedBigInteger('carGroupId')->nullable()->change();
            $table->unsignedBigInteger('carId')->nullable()->change();
            $table->unsignedBigInteger('carGroupId')->nullable()->change();
            $table->boolean('finished')->nullable()->change();
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
            //
        });
    }
}
