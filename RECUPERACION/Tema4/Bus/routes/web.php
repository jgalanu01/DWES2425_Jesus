<?php

use App\Http\Controllers\ConductorC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inicioR');


});

Route::controller(ConductorC::class)->group(
    function (){
        Route::get('inicio','inicioM')->name('inicioR');
        Route::post('billetes','billetesM')->name('billetesR');
    }
);
