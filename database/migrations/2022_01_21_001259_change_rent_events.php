<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_events', function (Blueprint $table) {
            $table->unsignedTinyInteger('priority')->nullable();
            $table->unsignedTinyInteger('duration')->nullable();
            $table->string('icon')->nullable();
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
            $table->dropColumn(['priority','duration','icon']);
        });
    }
}
