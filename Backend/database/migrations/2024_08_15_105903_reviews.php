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
            $table->unsignedBigInteger('reviewable_id'); 
            $table->string('reviewable_type'); 
            $table->integer('Rating');
            $table->text('ReviewText');
            $table->timestamp('ReviewDate');
            $table->timestamps();
            $table->index(['reviewable_id', 'reviewable_type']); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
