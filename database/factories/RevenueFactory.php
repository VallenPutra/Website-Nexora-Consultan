<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Revenue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Revenue>
 */
class RevenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = fake()->randomElement(['pending', 'paid', 'overdue']);
        $invoiceDate = fake()->dateTimeBetween('-6 months', 'now');

        return [
            'client_id' => Client::factory(),
            'project_id' => null,
            'description' => fake()->randomElement([
                'Website Development — Phase 1',
                'ERP Implementation Milestone',
                'Monthly Cloud Support Retainer',
                'Cybersecurity Audit',
                'UI/UX Design Package',
            ]),
            'amount' => fake()->numberBetween(5, 60) * 500_000,
            'status' => $status,
            'invoice_date' => $invoiceDate->format('Y-m-d'),
            'paid_at' => $status === 'paid' ? fake()->dateTimeBetween($invoiceDate, 'now')->format('Y-m-d') : null,
        ];
    }

    public function paid(): static
    {
        return $this->state(fn (array $attributes): array => [
            'status' => 'paid',
            'paid_at' => $attributes['invoice_date'] ?? now()->format('Y-m-d'),
        ]);
    }
}
