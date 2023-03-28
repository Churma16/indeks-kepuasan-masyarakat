<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Questionnaire>
 */
class QuestionnaireFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'judul' => fake()->sentence(),
            'kategori' => fake()->randomElement(['Umum', 'Kesehatan', 'Pendidikan', 'Lainnya']),
            'deskripsi' => fake()->paragraph(1),
            'waktu_ekspirasi' => fake()->dateTimeBetween('now', '+1 years'),
            'status_aktif' => fake()->randomElement(['Aktif', 'Tidak Aktif']),
            'created_at' => now(),
        ];
    }
}
