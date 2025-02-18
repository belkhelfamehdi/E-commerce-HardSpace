<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a User and uses its ID
            'quantity' => $this->faker->numberBetween(1, 10), // Random quantity between 1 and 10
            'price' => $this->faker->numberBetween(100, 1000), // Random price between 100 and 1000
            'product_id' => Product::factory(), // Creates a Product and uses its ID
        ];
    }
}
