<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\VerificaSeNaoEstaLogado;
use App\Http\Middleware\VerificaSeUsuarioEstaLogado;
use Illuminate\Support\Facades\Route;

Route::middleware([VerificaSeNaoEstaLogado::class])->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login-submit', [AuthController::class, 'loginSubmit']);
});


Route::middleware([VerificaSeUsuarioEstaLogado::class])->group(function() {
    Route::get('/', [MainController::class, 'index']);
    Route::get('/new-note', [MainController::class, 'newNote']);
    Route::get('/logout', [AuthController::class, 'logout']);
});


