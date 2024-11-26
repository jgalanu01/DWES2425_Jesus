<?php

use App\Http\Controllers\LoginC;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inicio', function () {
    return 'Página de inicio de usuarios logueados';
})->name('inicio');

Route::controller(LoginC::class)->group(
    function () {
        Route::get('login', 'vistaLogin')->name('vistaLogin'); //vista de login, carga la pantalla de login
        Route::post('login', 'loguear')->name('loguear'); //proceso de login
        Route::get('registrar', 'vistaRegistro')->name('vistaRegistro'); //vista de registro, carga la pantalla de registro
        Route::post('registrar', 'registrar')->name('registrar'); //proceso de registro
        Route::get('cerrar', 'cerrar')->name('cerrar'); //proceso de cerrar sesion



    }

);

