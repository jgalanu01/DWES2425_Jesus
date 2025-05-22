<?php

use App\Http\Controllers\videojuegoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('rInicio');
});

Route::controller(videojuegoC::class)->group(
    function (){
        Route::get('inicio','inicioM')->name('rInicio');
        Route::get('nuevoJuego','nuevoJuegoM')->name('nuevoJuegoR');
        Route::post('crearJuego','crearJuegoM')->name('crearJuegoR');
        Route::get('editarJuego{id}','editarJuegoM')->name('editarJuegoR');
        Route::put('actualizarJuego{id}','actualizarJuegoM')->name('actualizarJuegoR');
        Route::delete('borrarJuego{id}','borrarJuegoM')->name('borrarJuegoR');
        
    }
);
