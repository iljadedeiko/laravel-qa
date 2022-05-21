<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class QuestionsAnswersUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(3)->create()->each(function($user) {
            $user->questions()->saveMany(
                Question::factory()->count(rand(1,5))->make()
            )
                ->each(function($question) {
                    $question->answers()
                        ->saveMany(Answer::factory()
                            ->count(rand(1, 5))->make());
                });
        });
    }
}
