<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DetalleCitaController;
use Illuminate\Support\Facades\Route;

// Rutas para Citas
Route::get('citas', [CitaController::class, 'index']); // Ver citas
Route::post('citas', [CitaController::class, 'store']); // Crear cita
Route::get('detalleCita/{id}', [CitaController::class, 'detalleCita']); // Ver detalle de una cita
