<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeTimeSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::table('time_sheets', function (Blueprint $table) {
                $table->uuid('uuid');
            });
        
        DB::statement('update time_sheets set uuid=uuid()');
        
        Schema::table('time_sheets', function (Blueprint $table) {
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
        Schema::table('time_sheets', function (Blueprint $table) {
            $table->dropColumn(['uuid']);
        });
    }
}
