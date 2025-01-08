<?php

use App\Http\Controllers\TareaController;
use App\Models\Tarea;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::apiResource('tareas', App\Http\Controllers\TareaController::class)
    ->withoutMiddleware(VerifyCsrfToken::class);
