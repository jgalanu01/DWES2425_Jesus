<?php

use App\Http\Controllers\RecursoController;
use Illuminate\Support\Facades\Route;


Route::get('recursos', [RecursoController::class, 'index']); 


Route::post('recursos', [RecursoController::class, 'store'])->middleware('auth:sanctum');
Route::put('recursos/{id}', [RecursoController::class, 'update'])->middleware('auth:sanctum'); 
Route::delete('recursos/{id}', [RecursoController::class, 'destroy'])->middleware('auth:sanctum'); 
