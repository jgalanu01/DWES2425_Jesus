<?php

use App\Http\Controllers\ContenidoController;
use App\Http\Controllers\ReproduccionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('contenidos',[ContenidoController::class,'index']);
Route::post('reproducir/{id}',[ReproduccionController::class,'index']);
Route::post('reproducciones/{email}',[ReproduccionController::class,'obtenerReproducciones']);

