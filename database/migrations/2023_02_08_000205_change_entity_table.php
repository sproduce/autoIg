<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeEntityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rent_document_entities', function (Blueprint $table) {
            $table->dropColumn(['ogrnip',]);
            $table->date('dateReg')->nullable()->change();
            $table->string('nameReg')->nullable()->change();
            $table->text('okved')->nullable()->change();
            $table->string('okpo')->nullable()->change();
            $table->string('okato')->nullable()->change();
            $table->string('kpp')->nullable();
            $table->string('director')->nullable()->change();
            $table->string('accountant')->nullable()->change();
            
            $table->string('oktmo')->nullable();
            $table->text('okved')->nullable()->change();
            $table->text('address')->change();
            $table->text('mailingAddress')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rent_document_entities', function (Blueprint $table) {
            $table->string('ogrnip');
            $table->dropColumn(['oktmo','kpp',]);
        });
    }
}
