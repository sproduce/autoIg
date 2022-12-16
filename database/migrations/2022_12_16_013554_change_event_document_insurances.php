<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEventDocumentInsurances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_event_document_insurances', function (Blueprint $table) {
            $table->unsignedBigInteger('subject');
            $table->unsignedBigInteger('subjectTo');
            $table->date('dateDocument');
            $table->string('marks')->nullable();
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
        Schema::table('rent_event_document_insurances', function (Blueprint $table) {
            $table->dropColumn(['subject','subjectTo','dateDocument','marks','comment']);
        });
    }
}
