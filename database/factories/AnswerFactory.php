<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            //this code going to factoory the data
            'respondent_id' => $this->faker->numberBetween(1, 30),
            'question_id' => $this->faker->numberBetween(1, 50),
            'jawaban' => $this->faker->numberBetween(1, 5),
            
        ];
    }
}
