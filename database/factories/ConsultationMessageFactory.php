<?php

namespace Database\Factories;

use App\Models\ConsultationMessage;
use App\Models\ConsultationRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ConsultationMessage>
 */
class ConsultationMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'consultation_request_id' => ConsultationRequest::factory(),
            'sender_type' => 'visitor',
            'body' => fake()->sentence(),
        ];
    }
}
