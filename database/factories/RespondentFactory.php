<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Respondent>
 */
class RespondentFactory extends Factory
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
            'questionnaire_id' => $this->faker->numberBetween(1, 10),

            'umur'=>$this->faker->numberBetween(1,5),
            'gender'=>$this->faker->randomElement(['Pria','Wanita']),
            'waktu_pengisian'=>$this->faker->dateTimeBetween('-1 years', 'now', 'Asia/Jakarta'),
        ];
    }
}
