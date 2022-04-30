<?php

namespace App\Http\Controllers;

use App\Http\Requests\AskQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class QuestionsController extends Controller
{
    private $str = "\Illuminate\Support\Str";
    private $auth = "\Illuminate\Support\Facades\Auth";

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $questions = Question::with('user')
            ->latest()->paginate(8);
        $auth = $this->auth;
        $str = $this->str;

        return view('questions.index', compact('questions', 'str', 'auth', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $question = new Question();

        return view('questions.create', compact('question', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->questions()->create($request->all());

        return redirect()->route('questions.index')->with('success', __('Your question has been submitted'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        $str = $this->str;
        $auth = $this->auth;

        return view('questions.show', compact('question', 'str', 'auth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        $categories = Category::all();
        $questionCat = Category::where('id', $question->category_id)->first();

        return view("questions.edit", compact('question', 'categories', 'questionCat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        if (Gate::denies('update-question', $question)) {
            abort(403, "Access denied");
        }
        $question->update($request->only('category_id', 'title', 'body'));

        return redirect()->route('questions.index')->with('success', __('Your question has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if (Gate::denies('delete-question', $question)) {
            abort(403, "Access denied");
        }
        $question->delete();

        return redirect()->route('questions.index')->with('success', __('Your question has been deleted'));
    }
}
