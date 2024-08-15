<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('NotificationID');
            $table->unsignedBigInteger('UserID'); 
            $table->string('NotificationType');
            $table->timestamp('NotificationDate');
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
