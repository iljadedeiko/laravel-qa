<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Support\Facades\Gate;

class MarkAnswerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Answer $answer)
    {
        if (Gate::denies('mark-answer', $answer)) {
            abort(403, "Access denied");
        }

        $answer->question->markBestAnswer($answer);
        return back();
    }
}
