<?php

use App\Http\Controllers\API\CategoriesController;
use App\Http\Controllers\API\QuestionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/questions', [QuestionsController::class, 'index']);
