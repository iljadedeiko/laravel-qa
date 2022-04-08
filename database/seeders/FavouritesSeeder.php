<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\User;
use Illuminate\Database\Seeder;

class FavouritesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::pluck('id')->all();
        $usersCount = count($users);

        foreach (Question::all() as $question) {
            for ($i = 0; $i < rand(1, $usersCount); $i++) {
                $user = $users[$i];
                $question->favourites()->attach($user);
            }
        }
    }
}
