<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentSubject extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_subjects', function (Blueprint $table) {
            $table->foreign('regionId')->references('id')->on('rent_subject_regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_subjects', function (Blueprint $table) {
            $table->dropForeign(['regionId']);
        });
    }
}
