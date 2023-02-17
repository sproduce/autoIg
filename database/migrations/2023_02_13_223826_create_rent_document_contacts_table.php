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
            $table->string('phone');
            $table->uuid('linkUuid');
            $table->boolean('actual')->nullable();
        });
        DB::statement('insert into rent_document_contacts (linkUuid,phone,uuid) select rs.uuid,rsc.phone,uuid() from rent_subjects as rs,rent_subject_contacts as rsc where rsc.subjectId=rs.id and rsc.deleted_at is null');
        DB::statement('update rent_document_contacts as rdc inner join (select uuid from rent_document_contacts group by linkUuid) rdc1 on rdc.uuid=rdc1.uuid set rdc.actual=1');
        Schema::dropIfExists('rent_subject_contacts');
        //
        //
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
