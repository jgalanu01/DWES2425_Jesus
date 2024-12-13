<?php

namespace App\Http\Controllers;

use App\Models\Conciertos;
use App\Models\Entradas;
use Illuminate\Http\Request;

class ConciertoC extends Controller
{

    function verConciertos(){
        $conciertos=Conciertos::orderBy('titulo','DESC')->get();
        return view('conciertos',compact('conciertos'));

    }

}