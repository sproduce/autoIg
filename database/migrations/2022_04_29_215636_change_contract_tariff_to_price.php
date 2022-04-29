<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeContractTariffToPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->dropForeign(['tariffId']);
            $table->dropColumn('tariffId');
            $table->integer('price')->nullable();
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
            $table->dropColumn('price');
            $table->unsignedBigInteger('tariffId')->nullable();
            $table->foreign('tariffId')->references('id')->on('rent_contract_tariffs');
        });
    }
}
