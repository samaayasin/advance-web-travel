<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id('FlightID');
            $table->unsignedBigInteger('UserID');
            $table->string('AirlineName');
            $table->string('DepartureAirport');
            $table->string('ArrivalAirport');
            $table->dateTime('DepartureTime');
            $table->dateTime('ArrivalTime');
            $table->decimal('Price', 10, 2);
            $table->boolean('Availability');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
