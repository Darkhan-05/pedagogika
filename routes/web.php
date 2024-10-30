<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return Inertia('Home');
});

Route::post('/create-user', [UserController::class, 'store'])->name('user.store');


Route::get('/questions',[QuestionController::class,'index'])->name('questions');
Route::post('/questions',[QuestionController::class,'store']);
Route::put('/questions',[QuestionController::class,'update']);
Route::delete('/questions/{question}',[QuestionController::class,'destroy']);
Route::put('/answers',[AnswerController::class,'update']);

Route::get('/quiz',[QuizController::class,'index'])->name('quiz');
Route::post('/results',[QuizController::class,'results']);

Route::get('/leaderboard',[QuizController::class,'leaderBoard']);

Route::fallback(function(){
    return Inertia('Home');
});
