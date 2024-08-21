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
        Schema::create('cars', function (Blueprint $table) {
            $table->id('CarRentalID');
            $table->unsignedBigInteger('UserID');
            $table->string('CarModel');
            $table->year('Year');
            $table->string('Color');
            $table->decimal('PricePerDay', 10, 2);
            $table->boolean('Availability');
            $table->string('image_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};
