<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCarConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_configurations', function (Blueprint $table) {
            $table->string('nickName')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('pid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('car_configurations', function (Blueprint $table) {
            $table->dropColumn(['nickName','color','pid']);
        });
    }
}
