<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_id' => 1,
            'product_name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'product_qty' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 0, 1000),
            'supplier_id' => 1,
        ];
    }
}
