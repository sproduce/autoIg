<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDocumentEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_document_entities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('uuid');    
            $table->boolean('actual')->nullable();
            $table->string('fullName')->nullable();
            $table->string('shortName')->nullable();
            $table->string('englishName')->nullable();
            $table->string('address');
            $table->string('mailingAddress');
            $table->string('phone');
            $table->string('ogrn');
            $table->string('ogrnip');
            $table->date('dateReg');
            $table->string('nameReg');
            $table->string('director');
            $table->string('accountant');
            $table->string('okved');
            $table->string('okpo');
            $table->string('okato');
            $table->string('okogu');
            $table->string('inn');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_document_entities');
    }
}
