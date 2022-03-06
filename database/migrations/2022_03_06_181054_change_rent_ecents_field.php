<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentEcentsField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_events', function (Blueprint $table) {
            $table->boolean('isToPay')->default(true);
            $table->unsignedBigInteger('payOperationTypes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_events', function (Blueprint $table) {
            $table->dropColumn(['isToPay','payOperationTypes']);
        });
    }
}
