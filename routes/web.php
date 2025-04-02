<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

// Auth routes (open routes).
Route::middleware([CheckIsNotLogged::class])->group(function () {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login-submit', [AuthController::class, 'loginSubmit']);
});


// Auth routes (protected routes).
Route::middleware([CheckIsLogged::class])->group(function () {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/new-note', [MainController::class, 'newNote']);
    Route::get('/teste', [MainController::class, 'teste'])->name('teste');
    Route::get('/logout', [AuthController::class, 'logout']);
});

