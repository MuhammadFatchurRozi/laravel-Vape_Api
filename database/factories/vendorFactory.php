<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\vendor>
 */
class vendorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'vendor_name' => $this->faker->name(),
            'vendor_email' => $this->faker->unique()->safeEmail(),
            'vendor_phone' => $this->faker->phoneNumber(),
            'vendor_address' => $this->faker->address(),
            'vendor_city' => $this->faker->city(),
            'vendor_province' => $this->faker->state(),
            'vendor_postal_code' => $this->faker->postcode(),
            'vendor_country' => $this->faker->country(),
            'vendor_description' => $this->faker->text(),
        ];
    }
}
