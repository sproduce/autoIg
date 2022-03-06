<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentAdditionalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_additionals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('contractId');
            $table->foreign('contractId')->references('id')->on('rent_contracts');
            $table->unsignedBigInteger('timeSheetId');
            $table->foreign('timeSheetId')->references('id')->on('time_sheets');
            $table->unsignedBigInteger('toPaymentsId')->nullable();
            $table->unsignedInteger('sum');

            $table->boolean('isPay')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_additionals');
    }
}
