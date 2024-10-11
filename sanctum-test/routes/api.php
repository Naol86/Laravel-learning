<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('ping', function () {
    return response()->json(['message' => 'pong']);
});
Route::apiResource('/products', ProductController::class);