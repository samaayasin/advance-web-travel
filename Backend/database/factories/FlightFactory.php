<?php
namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    protected $model = Flight::class;

    public function definition()
    {
        return [
            'AirlineName' => $this->faker->company,
            'DepartureAirport' => $this->faker->city,
            'ArrivalAirport' => $this->faker->city,
            'DepartureTime' => $this->faker->dateTimeBetween('now', '+1 week'),
            'ArrivalTime' => $this->faker->dateTimeBetween('+1 week', '+2 weeks'),
            'Price' => $this->faker->randomFloat(2, 100, 1000),
            'UserID' => \App\Models\User::factory(), // Assuming UserID references a User model
            
            'Availability' => $this->faker->boolean,
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}
