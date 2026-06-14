<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ComplaintApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
    Route::get('/complaints', [ComplaintApiController::class, 'index']);
    Route::post('/complaints', [ComplaintApiController::class, 'store']);
});

// Route::apiResource('complaints', ComplaintApiController::class);
