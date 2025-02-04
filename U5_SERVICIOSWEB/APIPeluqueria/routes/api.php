<?php

use App\Http\Controllers\CitaController;
use App\Http\Controllers\DetalleCitaController;
use Illuminate\Support\Facades\Route;

// Rutas para Citas
Route::get('citas', [CitaController::class, 'index']); // Ver citas
Route::post('citas', [CitaController::class, 'store']); // Crear cita
Route::get('citas/{id}', [CitaController::class, 'show']); // Ver detalles de una cita
Route::post('citas/{id}/finalizar', [CitaController::class, 'finalizar']); // Finalizar cita
Route::delete('citas/{id}', [CitaController::class, 'destroy']); // Borrar cita

// Rutas para Detalle de Cita
Route::post('citas/{id}/detalle', [DetalleCitaController::class, 'store']); // Añadir detalle
Route::delete('citas/{id}/detalle/{detalleId}', [DetalleCitaController::class, 'destroy']); // Borrar detalle
