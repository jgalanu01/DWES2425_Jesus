<?php

use App\Http\Controllers\pilotosc;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inicioR');
});

Route::controller(pilotosc::class)->group(
    function(){
        Route::get('inicio','inicioM')->name('inicioR');
        Route::post('crearPiloto','crearPilotoM')->name('crearPilotoR');
        Route::get('modificar/{id}','modificarPilotoM')->name('modificarPilotoR');
        Route::put('actualizarPiloto/{id}','actualizarPilotoM')->name('actualizarPilotoR');
        Route::delete('borrarPiloto/{id}','borrarPilotoM')->name('borrarPilotoR');

    }
);