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
            $table->string('sts')->nullable();
            $table->string('regnumber')->nullable();
            $table->string('decreeNumber')->unique();
            $table->date('dateDecree');
            $table->date('datePayMax');
            $table->integer('sum');
            $table->string('unit')->nullable();
            $table->string('receiver');
            $table->string('inn');
            $table->string('kpp');
            $table->string('bik');
            $table->string('kbk');
            $table->string('okato');
            $table->string('bankReceiver');
            $table->string('accountReceiver');
            $table->dateTime('dateTimeFine')->nullable();
            $table->string('place')->nullable();
            $table->string('koap')->nullable();
            $table->integer('sale')->nullable();
            $table->date('dateSale')->nullable();
            $table->integer('sumSale')->nullable();
            $table->string('entity')->nullable();
            $table->boolean('closed')->nullable();
            $table->integer('timeSheetId')->nullable();
            $table->string('fromFile')->nullable();
            $table->date('dateFile')->nullable();
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
