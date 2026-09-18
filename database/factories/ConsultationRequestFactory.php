<?php

namespace Database\Factories;

use App\Models\ConsultationRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConsultationRequest>
 */
class ConsultationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'company' => fake()->company(),
            'phone' => fake()->phoneNumber(),
            'service' => fake()->randomElement(['IT Consulting', 'Web Development', 'ERP & Odoo Implementation']),
            'budget' => fake()->randomElement(['under-50m', '50-150m', '150-500m']),
            'message' => fake()->paragraph(),
            'status' => 'new',
            'admin_notes' => null,
        ];
    }
}
