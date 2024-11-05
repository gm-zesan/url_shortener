<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\URLController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/shorten', [URLController::class, 'shorten']);
        Route::get('/urls', [URLController::class, 'index']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::prefix('v2')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/shorten', [URLController::class, 'shorten']);
        Route::get('/{shortUrl}', [URLController::class, 'redirect']);
        Route::get('/urls', [URLController::class, 'index']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
