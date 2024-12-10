<?php

use App\Http\Controllers\CitaC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('verCitas');
});

Route::controller(CitaC::class)->group(
    function(){
        Route::get('citas', 'verCitas')->name('verCitas'); //consultar
        Route::put('citas/{id}','mofificarCita')->name('mofificarC'); //modificacion
        Route::delete('citas/{id}','borrarCita')->name('borrarC'); //borar
        Route::post('citas','crearCita')->name('crearC'); //inserción
        Route::get('detalle/{id}', 'cargarDetalle')->name('cargarDetalle');
        Route::post('detalle/{id}', 'insertarDetalle')->name('crearD');

    }
);

