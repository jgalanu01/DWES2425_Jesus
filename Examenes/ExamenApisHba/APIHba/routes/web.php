<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ContenidoController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/contenido',[ContenidoController::class,'index']);
Route::post('/reproducciones',[ClienteController::class,'obtenerReproducciones'])->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/ver',[ClienteController::class,'reproducir'])->withoutMiddleware([VerifyCsrfToken::class]);
