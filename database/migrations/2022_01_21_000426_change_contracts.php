<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->unsignedBigInteger('tariffId')->nullable()->change();
            $table->unsignedInteger('sum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {  Schema::table('rent_contracts', function (Blueprint $table) {
        $table->unsignedBigInteger('tariffId')->nullable(false)->change();
        $table->dropColumn(['sum']);
    });
    }
}
