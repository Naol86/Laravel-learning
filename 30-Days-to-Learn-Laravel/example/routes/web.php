<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');
// Route::resource('/jobs', JobController::class);

Route::get('/jobs', [JobController::class, 'index']);
Route::get('/jobs/{job}', [JobController::class, 'show']);

Route::middleware('auth')->group(function () {

  Route::get('/jobs/create', [JobController::class, 'create']);
  Route::post('/jobs', [JobController::class, 'store']);
  Route::middleware('can:edit,job')->group(function () {
    Route::get('/jobs/{job}/edit', [JobController::class, 'edit']);
    Route::patch('/jobs/{job}', [JobController::class, 'update']);
    Route::delete('/jobs/{job}', [JobController::class, 'destroy']);
  });
});






Route::view('/contact', 'contact');

// Auth 
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
