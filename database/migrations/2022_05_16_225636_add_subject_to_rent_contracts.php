<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectToRentContracts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {
            $table->renameColumn('subjectId','subjectIdFrom');
            $table->unsignedBigInteger('subjectIdTo')->nullable();
            $table->foreign('subjectIdTo')->references('id')->on('rent_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_contracts', function (Blueprint $table) {

        });
    }
}
