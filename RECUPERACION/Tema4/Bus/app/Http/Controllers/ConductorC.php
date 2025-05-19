<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Servicio;
use App\Models\Billete;
use Illuminate\Http\Request;

class ConductorC extends Controller
{
    // Muestra el formulario de identificación
    public function inicioM(){
        return view('vistaInicio'); 
    }

    // Procesa el formulario de identificación por DNI
    public function billetesM(Request $r){
        $r->validate([
            'dni'=>'required'
        ]);

        try {
            $conductor = Conductor::where('dni', $r->dni)->first();

            if ($conductor == null) {
                return back()->with('mensaje', 'El dni no existe');
            }

            

            $servicio = Servicio::where('conductor_id', $conductor->id)
                                ->where('fecha', date('Y-m-d'))
                                ->first();

            if ($servicio == null) {
                $servicio = new Servicio();
                $servicio->conductor_id = $conductor->id;
                $servicio->fecha = date('Y-m-d');
                $servicio->recaudacion = 0;
                $servicio->save();
            }

            return redirect()->route('ventaR', $conductor->id);

        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
    }

    // Muestra la vista de gestión de billetes para un conductor
    public function ventaM($idConductor){

        try {
            $conductor = Conductor::find($idConductor);
            
            if ($conductor == null) {
            return redirect()->route('inicioR')->with('mensaje', 'Conductor no encontrado');
            }
            
            
            $servicio = Servicio::where('conductor_id', $conductor->id)
            ->where('fecha', date('Y-m-d'))
            ->first();
            
            if ($servicio == null) {
            return redirect()->route('inicioR')->with('mensaje', 'No se ha creado el servicio para hoy');
            }
            
            $billetes = $servicio->billetes(); // relación hasMany en modelo Servicio
            
            return view('vistaBilletes', compact('conductor', 'servicio')); //No pasar billetes en el compact proque lo cogemos con el has many
            
            } catch (\Throwable $th) {
            return redirect()->route('inicioR')->with('mensaje', $th->getMessage());
   
    
    }
}
}
