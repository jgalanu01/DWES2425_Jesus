<?php

use App\Http\Controllers\RecursoController;
use App\Http\Controllers\ReservaController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('recursos', [RecursoController::class, 'index']); 
Route::post('reservas', [ReservaController::class, 'store'])->withoutMiddlewaremiddleware([VerifyCsrfToken::class]);    



