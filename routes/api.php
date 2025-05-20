<?php

use App\Http\Controllers\Api\UserController;
use App\http\Controllers\Api\bookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('User', UserController::class);
Route::apiResource('books', bookController::class);
Route::get('/books', function (Request $request) {
    return $request->books();
})->middleware('auth:sanctum');

Route::get('/User', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

