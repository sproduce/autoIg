<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentEventFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rent_event_fines', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('dateTimeOrder');
            $table->dateTime('dateTimeFine');
            $table->date('datePaySale')->nullable();
            $table->date('datePayMax')->nullable();
            $table->unsignedInteger('sum')->nullable();
            $table->unsignedInteger('sumSale')->nullable();
            $table->string('uin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rent_event_fines');
    }
}
