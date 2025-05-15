<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorC extends Controller
{
    public function inicioM(){
        return view('vistaInicio');

    }
}
