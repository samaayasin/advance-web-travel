<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_flights', function (Blueprint $table) {
            $table->id('BookingID');
            $table->unsignedBigInteger('FlightID');
            $table->unsignedBigInteger('UserID');
            $table->string('ArrivalTime');
            $table->integer('Numberofpassengers');
            $table->decimal('TotalPrice', 8, 2);
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_flights');
    }
};
