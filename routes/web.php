<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MarkAnswerController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\VoteQuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Route::get('/', function () {
//    return redirect(app()->getLocale());
//});

//Route::group([
//    'prefix' => '{locale}',
//    'where' => ['locale' => '[a-zA-Z]{2}'],
//    'middleware' => 'setLocale',
//], function() {

    Route::get('/', function () {
        return view('home');
    });

    Auth::routes();

    //delete this
    Route::get('/home', [HomeController::class, 'index']);

    //question routes
    Route::get('/questions', [QuestionsController::class, 'index'])->name('questions.index');

    Route::get('/questions/create', [QuestionsController::class, 'create'])->name('questions.create');

    Route::post('/questions', [QuestionsController::class, 'store'])->name('questions.store');

    Route::get('/questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');

    Route::get('/questions/{question}/edit', [QuestionsController::class, 'edit'])->name('questions.edit');

    Route::put('/questions/{question}', [QuestionsController::class, 'update'])->name('questions.update');

    Route::delete('/questions/{question}', [QuestionsController::class, 'destroy'])->name('questions.destroy');

    //answer routes
    Route::post('/questions/{question}/answers', [AnswersController::class, 'store'])->name('questions.answers.store');

    Route::get('/questions/{question}/answers/{answer}/edit', [AnswersController::class, 'edit'])->name('questions.answers.edit');

    Route::put('/questions/{question}/answers/{answer}', [AnswersController::class, 'update'])->name('questions.answers.update');

    Route::delete('/questions/{question}/answers/{answer}', [AnswersController::class, 'destroy'])->name('questions.answers.destroy');

    Route::post('/answers/{answer}/mark', ['middleware'=>'auth', 'uses' => MarkAnswerController::class])->name('answers.mark');

    Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy'])->name('questions.unfavorite');

    Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store'])->name('questions.favorite');

    Route::post('/questions/{question}/vote-question', ['middleware'=>'auth', 'uses' => VoteQuestionController::class]);
//});
