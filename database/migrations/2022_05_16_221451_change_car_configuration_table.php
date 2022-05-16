<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCarConfigurationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('car_configurations', function (Blueprint $table) {
            $table->dropForeign(['ownerId']);
            $table->unsignedBigInteger('subjectId')->nullable();
            $table->foreign('subjectId')->references('id')->on('rent_subjects');
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
            $table->dropForeign(['subjectId']);
            $table->dropColumn('subjectId');
        });
    }
}
