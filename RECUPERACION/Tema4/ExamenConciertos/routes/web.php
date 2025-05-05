<?php

use App\Http\Controllers\ConciertoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('rInicio');
});

Route::controller(ConciertoC::class)->group(
    function (){
        Route::get('inicio','inicioM')->name('rInicio');
        Route::get('entradas/{idConcierto}','entradasM')->name('rEntradas');
        Route::post('entradas/{idConcierto}','venderM')->name('rVender');
        Route::delete('concierto/{idConcierto}','borrarM')->name('rBorrar');
        
    }
);
