<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubjectCarConfigurationsTable extends Migration
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
            $table->dropColumn(['ownerId']);
            $table->renameColumn('subjectId','subjectIdOwner');
            $table->unsignedBigInteger('subjectIdFrom')->nullable();
            $table->foreign('subjectIdFrom')->references('id')->on('rent_subjects');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
