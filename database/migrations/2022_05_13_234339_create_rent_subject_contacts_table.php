<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentSubjectContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_subject_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('phone');
            $table->unsignedBigInteger('subjectId');
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
        Schema::dropIfExists('rent_subject_contacts');
    }
}
