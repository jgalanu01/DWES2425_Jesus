<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConductorC;

Route::get('/', function () {
    return redirect()->route('inicioR');
});

Route::controller(ConductorC::class)->group(function () {
    Route::get('inicio', 'inicioM')->name('inicioR');
    Route::post('billetes', 'billetesM')->name('billetesR');
    Route::get('venta/{idConductor}', 'ventaM')->name('ventaR');
});

