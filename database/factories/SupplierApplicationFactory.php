<?php

namespace Database\Factories;

use App\Models\SupplierApplication;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupplierApplication>
 */
class SupplierApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupplierApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Create a new user or reference an existing one
            'company_name' => $this->faker->company(),
            'company_email' => $this->faker->companyEmail(),
            'company_number' => $this->faker->phoneNumber(),
            'company_country' => $this->faker->country(),
            'company_street' => $this->faker->streetAddress(),
            'company_city' => $this->faker->city(),
            'company_state' => $this->faker->state(),
            'company_zip' => $this->faker->postcode(),
            'message' => $this->faker->paragraph(),
            'statut' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
