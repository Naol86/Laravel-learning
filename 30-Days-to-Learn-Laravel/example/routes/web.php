<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\SessionController;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

Route::get('/jobs', [JobController::class, 'index']);

// Route::get('/jobs/create', function () {
//   dd('asdfas');
// });
Route::middleware('auth')->prefix('/jobs')->group(function () {

  Route::get('/create', [JobController::class, 'create'])->name('jobs.create');
  Route::post('/', [JobController::class, 'store']);
  Route::middleware('can:edit,job')->group(function () {
    Route::get('/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::patch('/{job}', [JobController::class, 'update']);
    Route::delete('/{job}', [JobController::class, 'destroy']);
  });
});

Route::get('/jobs/{job}', [JobController::class, 'show']);





Route::view('/contact', 'contact');

// Auth 
Route::get('/register', [RegisterUserController::class, 'create'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
