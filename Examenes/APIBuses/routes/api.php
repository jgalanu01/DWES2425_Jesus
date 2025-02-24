<?php

use App\Http\Controllers\ConductorController;
use App\Http\Controllers\BilleteController;
use Illuminate\Support\Facades\Route;


Route::post('crear', [ConductorController::class, 'crearConductor']);
Route::post('vender',[BilleteController::class, 'VenderBillete']);
