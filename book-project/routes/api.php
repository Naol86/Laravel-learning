<?php

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

Route::apiResource('/schools', SchoolController::class);
Route::apiResource('/departments', DepartmentController::class);
Route::apiResource('/courses', CourseController::class);
Route::apiResource('/books', BookController::class);