<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // Harusnya 9 digit, tapi karena masih testing, jadi 1 digit aja untuk menyamakan dengan tabel user
            'nip' => fake()->unique()->numberBetween(1,10),
            'nama' => fake()->name(),
            'nomor_hp' => fake()->unique()->phoneNumber(),
            'image' => fake()->imageUrl(),
            'created_at' => now(),
        ];
    }
}
