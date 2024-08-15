<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_flights', function (Blueprint $table) {
            $table->id('FlightID');
            $table->unsignedBigInteger('UserID'); 
            $table->string('AirlineName');
            $table->string('DepartureAirport');
            $table->string('ArrivalAirport');
            $table->dateTime('DepartureTime');
            $table->dateTime('ArrivalTime');
            $table->decimal('Price', 8, 2);
            $table->boolean('Availability');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->timestamps();

            $table->foreign('UserID')->references('UserID')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_flights');
    }
};
