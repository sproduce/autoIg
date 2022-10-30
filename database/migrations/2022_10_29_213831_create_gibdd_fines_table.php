<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGibddFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gibdd_fines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sts');
            $table->string('regnumber');
            $table->string('decreeNumber')->unique();
            $table->date('dateDecree');
            $table->date('datePayMax');
            $table->integer('sum');
            $table->string('unit');
            $table->string('receiver');
            $table->string('inn');
            $table->string('kpp');
            $table->string('bik');
            $table->string('kbk');
            $table->string('okato');
            $table->string('bankReceiver');
            $table->string('accountReceiver');
            $table->date('dateFine');
            $table->time('timeFine');
            $table->string('place');
            $table->string('koap');
            $table->integer('sale');
            $table->date('dateSale');
            $table->integer('sumSale');
            $table->string('entity')->nullable();
            $table->boolean('closed')->nullable();
            $table->integer('timeSheetId')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gibdd_fines');
    }
}
