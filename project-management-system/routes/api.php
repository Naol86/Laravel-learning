<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function(){
    Route::apiResource('/client', ClientController::class);
    Route::apiResource('/project', ProjectController::class);
    Route::apiResource('/task', TaskController::class);
});