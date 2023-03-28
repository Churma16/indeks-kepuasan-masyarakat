<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'questionarie_id' => $this->faker->numberBetween(1, 10),
            'nomor'=> $this->faker->numberBetween(1, 10),
            'isi' => $this->faker->sentence(),
            'created_at' => now(),
        ];
    }
}
