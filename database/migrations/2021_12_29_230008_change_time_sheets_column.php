<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTimeSheetsColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('time_sheets', function (Blueprint $table) {
            $table->dropColumn(['contractId','color']);
            $table->unsignedBigInteger('dataId')->nullable();
            $table->unsignedBigInteger('pId')->nullable();
            $table->unsignedMediumInteger('mileage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('time_sheets', function (Blueprint $table) {
            $table->dropColumn(['dataId','pId','mileage']);
            $table->unsignedBigInteger('contractId')->nullable();
            $table->string('color')->nullable();
        });

    }
}
