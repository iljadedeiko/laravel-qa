<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\MarkAnswerController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VoteAnswerController;
use App\Http\Controllers\VoteQuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
//Route::get('/', function () {
//    return redirect(app()->getLocale());
//});

//Route::group([
//    'prefix' => '{locale}',
//    'where' => ['locale' => '[a-zA-Z]{2}'],
//    'middleware' => 'setLocale',
//], function() {

    Auth::routes();

    //reset password routes
    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password.index');

    Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgot.password.store');

    Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('reset.password.show');

    Route::post('reset-password', [ResetPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.store');

    //question routes
    Route::get('/', [QuestionsController::class, 'index'])->name('questions.index');

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

    Route::post('/answers/{answer}/mark', ['middleware' => 'auth', 'uses' => MarkAnswerController::class])->name('answers.mark');

    //favorites routes
    Route::get('/questions/favorites/{user}', [FavoritesController::class, 'index'])->name('favorites.index');

    Route::post('/questions/{question}/favorites', [FavoritesController::class, 'store'])->name('questions.favorite');

    Route::delete('/questions/{question}/favorites', [FavoritesController::class, 'destroy'])->name('questions.unfavorite');

    //vote answer route
    Route::post('/answers/{answer}/vote-answer', ['middleware' => 'auth', 'uses' => VoteAnswerController::class]);

    //vote question route
    Route::post('/questions/{question}/vote-question', ['middleware' => 'auth', 'uses' => VoteQuestionController::class]);

    //user profile route
    Route::get('/user/{user}/profile', [UserProfileController::class, 'show'])->name('user.profile.show');

    Route::get('/user/{user}/profile/edit', [UserProfileController::class, 'edit'])->name('user.profile.edit');

    Route::delete('/user/{user}/profile/delete', [UserProfileController::class, 'destroy'])->name('user.profile.destroy');

    Route::put('/user/{user}/profile/update', [UserProfileController::class, 'update'])->name('user.profile.update');

    Route::put('/user/{user}/profile/update-avatar', [UserProfileController::class, 'updateAvatar'])->name('user.profile.update-avatar');

    //Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard.index');
//});
