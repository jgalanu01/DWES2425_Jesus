<?php

use App\Http\Controllers\ConductorC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('identificarC');
    
});

Route::controller(ConductorC::class)->group(
    function(){
        Route::post('conductor','identificarConductor')->name('identificarC');
        Route::get('conductor', 'comprobarDni')->name('comprobarD');
        Route::post('servicios','crearServicios')->name('crearS');
        Route::post('billetes/{id}', 'registrarBillete')->name('registrarB');
        
        
    }
);



