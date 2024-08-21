<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id('HotelID');
            $table->unsignedBigInteger('UserID');
            $table->string('HotelName');
            $table->unsignedTinyInteger('rating');
            $table->decimal('PricePerNight', 10, 2);
            $table->boolean('Availability');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('city');
            $table->string('county');
            $table->text('description')->nullable();
            $table->string('image_url')->nullable();
            $table->integer('number_of_guests');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hotels');
    }
};
