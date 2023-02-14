<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDocumentContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_document_contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid');
            $table->string('number');
            $table->uuid('linkUuid');
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
        Schema::dropIfExists('rent_document_contacts');
    }
}
