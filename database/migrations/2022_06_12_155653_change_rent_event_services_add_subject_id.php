<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentEventServicesAddSubjectId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_event_services', function (Blueprint $table) {
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
        Schema::table('rent_event_services', function (Blueprint $table) {
            $table->dropForeign(['subjectId']);
            $table->dropColumn('subjectId');
        });
    }
}
