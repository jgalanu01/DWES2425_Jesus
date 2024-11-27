<?php

use App\Http\Controllers\LoginC;
use App\Http\Controllers\ProductosC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inicio');
});



Route::controller(LoginC::class)->group(
    function () {
        Route::get('login', 'vistaLogin')->name('login'); //vista de login, carga la pantalla de login
        Route::post('login', 'loguear')->name('loguear'); //proceso de login
        Route::get('registrar', 'vistaRegistro')->name('vistaRegistro'); //vista de registro, carga la pantalla de registro
        Route::post('registrar', 'registrar')->name('registrar'); //proceso de registro
        Route::get('cerrar', 'cerrar')->name('cerrar'); //proceso de cerrar sesion



    }

);

Route::controller(ProductosC::class)->group(
    function(){
        Route::get('/inicio', 'verProductos')->name('inicio')->middleware('auth'); //El middleware auth es el que verifica que el usuario este logueado, si esta logueado accedes y si no te redirige a login
          
       
    }
);

