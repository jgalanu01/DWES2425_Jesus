<?php

use App\Http\Controllers\LibroC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('verP');
});
// Copiar pegar
Route::controller(LibroC::class)->group(
    function(){
        Route::get('prestamos','verPrestamos')->name('verP');
        Route::post('prestamos','crearPrestamo')->name('crearP');
        Route::put('prestamos/{id}','modificarPrestamo')->name('modificarP');
        Route::get('prestamosCar/{id}','cargarPrestamo')->name('cargarP');
        Route::get('prestamosC','insertarPrestamo')->name('insertarP');
    }
);
// Copiar pegar