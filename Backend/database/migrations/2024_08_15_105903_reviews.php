<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id('ReviewID');
            $table->unsignedBigInteger('BookingID');
            $table->string('BookingType');
            $table->integer('Rating');
            $table->text('ReviewText')->nullable();
            $table->timestamp('ReviewDate')->nullable();  // Adjusted to nullable
            $table->timestamps();  // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }

};
