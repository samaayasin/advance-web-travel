<?php
namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        $carModels = [
            'Toyota Camry', 'Honda Accord', 'Ford Mustang', 'Chevrolet Malibu',
            'Nissan Altima', 'BMW 3 Series', 'Audi A4', 'Mercedes-Benz C-Class',
            'Volkswagen Golf', 'Hyundai Sonata', 'Kia Optima', 'Mazda 3',
            'Subaru Impreza', 'Lexus ES', 'Tesla Model 3', 'Jeep Wrangler'
        ];


        return [
            'CarModel' => $this->faker->randomElement($carModels),
            'Year' => $this->faker->year,
            'Color' => $this->faker->safeColorName,
            'PricePerDay' => $this->faker->randomFloat(2, 20, 300),
            'Availability' => $this->faker->boolean,
            'UserID' => \App\Models\User::factory(), // Assuming AdminID references a User model
            'image_url' => $this->faker->imageUrl(),
        ];
    }
}

