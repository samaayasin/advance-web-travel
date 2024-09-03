<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('booking_hotels', function (Blueprint $table) {
            $table->id('BookingID');
            $table->unsignedBigInteger('HotelID');
            $table->unsignedBigInteger('UserID');
            $table->decimal('TotalPrice', 8, 2);
            $table->date('StartDate');
            $table->date('EndDate');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('booking_hotels');
    }
};
