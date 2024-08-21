<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed the Users table
        User::factory(10)->create();

        // Seed the Cars table
        Car::factory(50)->create();

        // Seed the Flights table
        Flight::factory(50)->create();

        // Seed the Hotels table
        Hotel::factory(50)->create();

        // Add other seeders as needed
    }
}
