<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentDocumentPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_document_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->uuid('linkUuid');
            $table->string('checkingAccount');
            $table->string('bankName');
            $table->string('bankInn');
            $table->string('bankBik');
            $table->string('correspondentAccount');
            $table->string('address');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_document_payments');
    }
}
