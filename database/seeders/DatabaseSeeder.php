<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Answer;
use App\Models\Questionnaire;
use App\Models\Question;
use App\Models\User;
use App\Models\Respondent;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Admin::factory(10)->create();

        Questionnaire::factory(10)->create();

        Question::factory(50)->create();

        User::factory(10)->create();

        Respondent::factory(30)->create();

        Answer::factory(50)->create();
    }
}
