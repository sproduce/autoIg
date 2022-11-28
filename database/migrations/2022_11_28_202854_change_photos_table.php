<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('photos', function (Blueprint $table) {
            $table->string('fileType')->nullable();
            $table->string('fileName')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('photos', function (Blueprint $table) {
            $table->dropColumn(['fileType','fileName']);
        });
          
    }
}
