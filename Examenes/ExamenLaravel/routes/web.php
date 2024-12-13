<?php

use App\Http\Controllers\ConciertoC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('verConciertos');
});

Route::controller(ConciertoC::class)->group(
    function(){
        Route::get('conciertos','verConciertos')->name('verConciertos');
        Route::get('entradas/{id}','verEntradas')->name('verEntradas');
        Route::post('entradas','venderEntradas')->name('venderE');
        Route::delete('entradas/{id}','borraConcierto')->name('BorrarC');
    }
);
