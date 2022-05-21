<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request, Answer $answer)
    {
        $voteAnswer = $request->vote_answer;
        Auth::user()->voteAnswer($answer, $voteAnswer);

        return back();
    }
}
