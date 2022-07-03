<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEventServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_event_services', function (Blueprint $table) {
            $table->dropColumn(['clientId','dateTime']);
            $table->unsignedBigInteger('contractId')->nullable();
            $table->foreign('contractId')->references('id')->on('rent_contracts');
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
