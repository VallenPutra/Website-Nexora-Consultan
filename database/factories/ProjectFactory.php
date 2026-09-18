<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'name' => fake()->catchPhrase(),
            'service' => fake()->randomElement(['Web Development', 'ERP & Odoo', 'Cloud Solutions', 'Cybersecurity']),
            'progress' => fake()->numberBetween(0, 100),
            'status' => fake()->randomElement(['planning', 'in_progress', 'on_review', 'completed']),
            'deadline' => fake()->dateTimeBetween('now', '+6 months')->format('Y-m-d'),
            'description' => fake()->optional()->paragraph(),
        ];
    }
}
