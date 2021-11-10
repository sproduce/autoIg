<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldToCarConfiguration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_configurations', function (Blueprint $table) {
            $table->date('dateStart')->nullable();
            $table->date('dateFinish')->nullable();
            $table->string('comment')->nullable();
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
            $table->dropColumn(['dateStart','dateFinish','comment']);
        });
    }
}
