<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('UserID'); 
            $table->string('Name');
            $table->string('Email')->unique();
            $table->string('Password');
            $table->string('PhoneNumber');
            $table->string('ProfilePicture')->nullable();
            $table->string('Role');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
