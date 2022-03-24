<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionsController;
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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('/', [QuestionsController::class, 'index'])->name('questions.index');

Route::resource('questions', QuestionsController::class)->except('show');

//Route::post('/questions/{question}/answers', 'AnswersController@store')->name('answers.store');
Route::resource('questions.answers', AnswersController::class)->except(['index', 'create', 'show']);

Route::get('/questions/{slug}', [QuestionsController::class, 'show'])->name('questions.show');

