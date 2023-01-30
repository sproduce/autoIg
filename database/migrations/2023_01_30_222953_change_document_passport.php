<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeDocumentPassport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_document_passports', function (Blueprint $table) {
            $table->uuid('uuid')->unique();    
            $table->boolean('actual')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_document_passports', function (Blueprint $table) {
            $table->dropColumn(['uuid','actual']);
        });
    }
}
