<?php

use App\Http\Controllers\CitaC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inicioR');
});

Route::controller(CitaC::class)->group(
    function(){
        Route::get('inicio','inicioM')->name('inicioR');
        Route::post('crearCita','crearCitaM')->name('crearCitaR');
        Route::get('detalleCita/{id}','detalleCitaM')->name('detalleCitaR');
        Route::post('aniadir/{id}','aniadirM')->name('aniadirR');
        Route::put('finalizarCita/{id}','finalizarCitaM')->name('finalizarCitaR');
    }
);
