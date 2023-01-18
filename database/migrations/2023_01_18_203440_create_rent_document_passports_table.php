<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDocumentPassportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_document_passports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('linkUuid');
            $table->string('number');
            $table->string('birthplace')->nullable();
            $table->date('dateIssued');
            $table->string('issuedBy');
            $table->string('code')->nullable();
            $table->string('placeResidence');
            $table->date('dateResidence');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_document_passports');
    }
}
