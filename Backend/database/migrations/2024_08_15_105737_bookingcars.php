<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_cars', function (Blueprint $table) {
            $table->id('CarRentalID');
            $table->unsignedBigInteger('UserID'); 
            $table->string('CarModel');
            $table->integer('SeatNumber');
            $table->string('Location');
            $table->decimal('PricePerDay', 8, 2);
            $table->boolean('Availability');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_cars');
    }
};
