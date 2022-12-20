<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'categories_id' => $this->faker->numberBetween(1, 20),
            'cart_id' => $this->faker->numberBetween(1, 10),
            'vendor_id' => $this->faker->numberBetween(1, 10),
            'product_name' => $this->faker->word(),
            'quantity' => $this->faker->numberBetween(1, 10),
            'price' => $this->faker->numberBetween(10000, 100000),
            'description' => $this->faker->text(),
        ];
    }
}
