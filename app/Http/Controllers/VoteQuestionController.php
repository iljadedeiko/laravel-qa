<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Question $question, User $user)
    {
        $voteQuestion = (int)request()->vote_question;
        Auth::user()->voteQuestion($question, $voteQuestion);

        return back();
    }
}
