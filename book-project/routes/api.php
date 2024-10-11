<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SchoolController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/ping', function() {
    return response()->json([
        'message' => 'pong'
    ]);
});

Route::prefix('/auth')->group( function () {
    Route::post('/signin', [AuthenticatedSessionController::class, 'store']);
    Route::post('/signup', [RegisteredUserController::class, 'store']);
});

Route::apiResource('/schools', SchoolController::class);
Route::apiResource('/departments', DepartmentController::class);
Route::apiResource('/courses', CourseController::class);
Route::apiResource('/books', BookController::class);