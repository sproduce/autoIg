<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDocumentLicensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_document_licenses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid');    
            $table->uuid('linkUuid');    
            $table->boolean('actual')->nullable();
            $table->string('number');
            $table->string('city');
            $table->string('issuedBy');
            $table->date('start');
            $table->date('finish');
            $table->string('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_document_licenses');
    }
}
