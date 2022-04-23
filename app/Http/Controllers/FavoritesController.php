<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Question $question)
    {
        $question->favorites()->attach(Auth::id());
        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(Auth::id());
        return back();
    }
}
