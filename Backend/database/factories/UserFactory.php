<?php
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        // Reset unique memory cache at the start
        $this->faker->unique(true);

        return [
            'Name' => $this->faker->name(),
            'Email' => $this->faker->unique()->safeEmail(),
            'Password' => bcrypt('password'), // Adjust as necessary
            'PhoneNumber' => $this->faker->phoneNumber(),
            'ProfilePicture' => $this->faker->imageUrl(640, 480, 'people', true),
            'Role' => $this->faker->randomElement(['user', 'admin']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
