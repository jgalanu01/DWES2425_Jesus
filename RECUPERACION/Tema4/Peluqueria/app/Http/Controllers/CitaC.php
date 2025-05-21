<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Servicio;

class Citac extends Controller
{

    function inicioM(){
        $cita=Cita::orderBy('fecha','DESC')->orderBy('hora','ASC')->get();

        return view('vistaInicio',compact('cita'));
    }

    function crearCitaM(Request $request){
        $request->validate([
            "fecha"=>"required",
            "hora"=>"required",
            "cliente"=>"required"
        ]);

        try {
            
        } catch (\Throwable $th) {

             return back()->with('mensaje', $th->getMessage());
        }

    }
    
}
