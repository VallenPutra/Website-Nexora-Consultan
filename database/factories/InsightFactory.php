<?php

namespace Database\Factories;

use App\Models\Insight;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Insight>
 */
class InsightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'slug' => fake()->unique()->slug(),
            'category' => fake()->randomElement(['Business', 'Cloud', 'Digital Transformation', 'IT Security']),
            'title' => fake()->sentence(6),
            'excerpt' => fake()->paragraph(),
            'author' => 'NEXORA Editorial Team',
            'published_at' => fake()->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'body' => fake()->paragraphs(3, true),
            'is_published' => true,
        ];
    }
}
