<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class FavouritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favourites()->attach(Auth::id());
        return back();
    }

    public function destroy(Question $question)
    {
        $question->favourites()->detach(Auth::id());
        return back();
    }
}
