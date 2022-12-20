<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\customer>
 */
class customerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => $this->faker->numberBetween(1, 15),
            'name' => fake()->name,
            'email' => fake()->email,
            'password' => bcrypt('12345678'),
            'profile_photo_path' => fake()->imageUrl,
            'birth_date' => fake()->date,
            'address' => fake()->address,
            'phone' => fake()->phoneNumber,
        ];
    }
}
