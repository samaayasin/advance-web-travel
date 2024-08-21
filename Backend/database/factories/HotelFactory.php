<?php
namespace Database\Factories;

use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition()
    {
        return [
            'HotelName' => $this->faker->company,
            'rating' => $this->faker->numberBetween(1, 5),
            'PricePerNight' => $this->faker->randomFloat(2, 50, 500),
            'Availability' => $this->faker->boolean,
            'StartDate' => $this->faker->dateTimeBetween('now', '+1 month'),
            'EndDate' => $this->faker->dateTimeBetween('+1 month', '+6 months'),
            'city' => $this->faker->city,
            'county' => $this->faker->state,
            'description' => $this->faker->paragraph,
            'image_url' => $this->faker->imageUrl(),
            'number_of_guests' => $this->faker->numberBetween(1, 10),
            'UserID' => \App\Models\User::factory(),  // Assuming UserID references a User model
        ];
    }
}
