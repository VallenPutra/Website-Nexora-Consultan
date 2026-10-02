<?php

namespace Database\Factories;

use App\Models\PortfolioItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PortfolioItem>
 */
class PortfolioItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name_id' => fake()->company(),
            'name_en' => fake()->company(),
            'work_id' => fake()->sentence(),
            'work_en' => fake()->sentence(),
            'category' => fake()->randomElement(array_keys(PortfolioItem::CATEGORIES)),
            'image_path' => null,
            'sort_order' => fake()->numberBetween(0, 999),
        ];
    }
}
