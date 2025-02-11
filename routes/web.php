<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\Questions\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;



Route::post('/quiz/submit-answer', [QuizController::class, 'submitAnswer'])->name('quiz.submitAnswer');
Route::post('/quiz/submitQuiz', [QuizController::class, 'submitQuiz'])->name('quiz.submitQuiz');


Route::get('/', function () {
    return view('home');
})->name('home');
Route::get('/quiz', [QuizController::class, 'index']);

Route::get('/quiz/get-question/{index}', [QuizController::class, 'getQuestion']);
Route::get('/quiz/get-questions', [QuizController::class, 'getRandomQuestions']);
Route::get('/quiz/results', [QuizController::class, 'showResults'])->name('quiz.results');


Route::get('/questions/list', [QuizController::class, 'index'])->name('quiz');

Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
