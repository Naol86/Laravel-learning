<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    $role = $user->hasRole('admin');
    return response()->json([
        'user' => $user,
        'role' => $role
    ]);
});

Route::prefix('/auth')->group(function () {
    Route::post('/signin', [AuthenticatedSessionController::class, 'store']);
    Route::post('/signup', [RegisteredUserController::class, 'store']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::middleware(['project.role:owner'])->group(function () {
        Route::apiResource('/projects', ProjectController::class);
    });
    Route::apiResource('/products', ProductController::class);
});