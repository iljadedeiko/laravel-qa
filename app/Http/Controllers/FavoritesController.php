<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    private $str = "\Illuminate\Support\Str";

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $str = $this->str;
        $categories = Category::all();
        $userFavQuestions = $user->favorites()->latest()->paginate(8);

        return view('favorites.index', compact('userFavQuestions', 'categories', 'str'));
    }

    public function store(Question $question)
    {
        $question->favorites()->attach(Auth::id());

        return back();
    }

    public function destroy(Question $question)
    {
        $question->favorites()->detach(Auth::id());
        return back()->with('success', __('The question has been removed from the favorites'));
    }
}
