<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentEventDocumentTitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('rent_event_document_titles', function (Blueprint $table) {
            $table->string('color');
            $table->string('issued');
            $table->date('dateDocument')->nullable();
            $table->unsignedBigInteger('subjectId');
            $table->unsignedBigInteger('ownerSubjectId');
            $table->string('marks')->nullable();
            $table->string('comment')->nullable();
            $table->string('passport')->nullable()->change();
            $table->foreign('subjectId')->references('id')->on('rent_subjects');
            $table->foreign('ownerSubjectId')->references('id')->on('rent_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('rent_event_document_titles', function (Blueprint $table) {
            $table->dropColumn(['color','issued','marks','comment','dateDocument','subjectId','ownerSubjectId']);
        });
    }
}
