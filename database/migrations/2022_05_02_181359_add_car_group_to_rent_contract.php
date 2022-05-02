<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarGroupToRentContract extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('carGroupId')->nullable();
            $table->foreign('carGroupId')->references('id')->on('rent_car_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->dropForeign(['carGroupId']);
            $table->dropColumn('carGroupId');
        });
    }
}
