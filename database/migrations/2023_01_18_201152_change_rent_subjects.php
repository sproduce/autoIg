<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeRentSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_subjects', function (Blueprint $table) {
                $table->uuid('uuid');
            });
        
        DB::statement('update rent_subjects set uuid=uuid()');
        
        Schema::table('rent_subjects', function (Blueprint $table) {
            $table->unique('uuid');
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
            $table->dropColumn(['uuid']);
        });
    }
}
