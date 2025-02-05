<?php

use App\Http\Controllers\CitaController;
use Illuminate\Support\Facades\Route;

// Ruta para obtener todas las citas con su importe total
Route::get('citas', [CitaController::class, 'index']);

// Ruta para crear una nueva cita
Route::post('citas', [CitaController::class, 'store']);

// Ruta para obtener el detalle de una cita
Route::get('detalleCita/{id}', [CitaController::class, 'detalleCita']);

// Ruta para agregar un detalle a una cita (solo si no está finalizada)
Route::post('detalleCita', [CitaController::class, 'agregarDetalle']);

// Ruta para borrar un detalle de una cita (solo si no está finalizada)
Route::delete('detalleCita/{id}', [CitaController::class, 'borrarDetalle']);

// Ruta para borrar una cita (solo si no tiene detalles)
Route::delete('citas/{id}', [CitaController::class, 'borrarCita']);

// Ruta para finalizar una cita
Route::put('citas/{id}/finalizar', [CitaController::class, 'finalizarCita']);
