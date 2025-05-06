<?php

use App\Http\Controllers\ConciertoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('rInicio');
});

Route::controller(ConciertoC::class)->group(
    function (){
        Route::get('inicio','inicioM')->name('rInicio');
        Route::get('entradas','entradasM')->name('rEntradas'); //Aquí tendria que tener el id concierto tambien como en la de abajo pero lo vamos a pasar en el formulario de Concierto en vez de aquí en la ruta
        Route::post('entradas/{idConcierto}','venderM')->name('rVender');
        Route::delete('concierto/{idConcierto}','borrarM')->name('rBorrar');
        
    }
);
