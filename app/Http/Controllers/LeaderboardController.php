<?php

namespace App\Http\Controllers;

use App\Models\User;

class LeaderboardController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->orderBy('rating', 'DESC')
            ->get();

        $place = 1;

        return view('leaderboard.index', compact('users', 'place'));
    }
}
