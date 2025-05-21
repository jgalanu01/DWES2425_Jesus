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
    }
);
