<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorrentEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_events', function (Blueprint $table) {
            $table->string('colorPartPay')->nullable();
            $table->string('colorPay')->nullable();
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
            $table->dropColumn(['colorPartPay','colorPay']);
        });

    }
}
