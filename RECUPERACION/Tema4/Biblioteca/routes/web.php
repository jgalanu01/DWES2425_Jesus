<?php

use App\Http\Controllers\prestamoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('prestamosR');
});

Route::controller(prestamoC::class)->group(
function(){
    Route::get('prestamos','prestamosM')->name('prestamosR');
    Route::get('crearPrestamo','crearPrestamoM')->name('crearPrestamoR');
    Route::post('insertarPrestamo','insertarPrestamoM')->name('insertarPrestamoR');
    Route::put('modificarPrestamo/{id}','modificarPrestamoM')->name('modificarPrestamoR');
    Route::get('formularioModificar','formularioModificarM')->name('formularioModificarR');
}
);
