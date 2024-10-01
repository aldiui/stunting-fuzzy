<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\KalkulatorFuzzyController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['token'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('chat', [ChatController::class, 'index']);
    Route::post('chat', [ChatController::class, 'store']);
    Route::get('user', [UserController::class, 'index']);
    Route::put('user', [UserController::class, 'update']);
    Route::get('news', [NewsController::class, 'index']);
    Route::get('news/{id}', [NewsController::class, 'show']);
    Route::get('kalkulator-fuzzy', [KalkulatorFuzzyController::class, 'index']);
    Route::get('kalkulator-fuzzy/{id}', [KalkulatorFuzzyController::class, 'show']);
    Route::post('kalkulator-fuzzy', [KalkulatorFuzzyController::class, 'store']);
});
