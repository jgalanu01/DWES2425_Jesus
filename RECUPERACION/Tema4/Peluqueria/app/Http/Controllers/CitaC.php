<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\DetalleCita;
use App\Models\Servicio;
use Illuminate\Http\Request;


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
            $cita=new Cita();
            $cita->fecha=$request->fecha;
            $cita->hora=$request->hora;
            $cita->cliente=$request->cliente;
            $cita->total=0;

            if($cita->save()){
                return back()->with('info','Cita creada');
            }else{
                return back()->with('mensaje', 'Error al crear la cita');
            }
            
        } catch (\Throwable $th) {

             return back()->with('mensaje', $th->getMessage());
        }

    }

    function detalleCitaM($id){
        $cita=Cita::find($id);
        $servicio=Servicio::all();
        if($cita!=null){
            return view('detalle',compact('cita','servicio'));

        }else{
            return back('mensaje','Error, no existe la cita');
        }


        
    }

    function aniadirM(Request $request,$id){
        $cita=Cita::find($id);

        if($cita!=null){
            $servicio=Servicio::find($request->servicio);
            if($servicio!=null){
                try {
                    $d=new DetalleCita();
                    $d->cita_id=$cita->id;
                    $d->servicio_id=$servicio->id;
                    $d->precio=$servicio->precio;
                    if($d->save()){
                        return back()->with('mensaje','Servicio añadido');
                    }else{
                        return back()->with('mensaje','Error, no se ha añadido el servicio');
                    }
                   
                } catch (\Throwable $th) {
                    return back()->with('mensaje', $th->getMessage());
                }
            }else{
                return back()->with('mensaje','Error, no existe el servicio');
            }
        }else{
            return back()->with('mensaje','Error, no existe la cita');
        }

    }

    function finalizarCitaM($id){
        $cita = Cita::find($id);
        if ($cita != null) {
          
            foreach ($cita->detalleCitas() as $d) {
                $cita->total += $d->precio;
            }
            if ($cita->save()) {
                return back()->with('mensaje', 'Finalizar');
            } else {
                return back()->with('mensaje', 'Error');
            }
        } else {
            return back()->with('mensaje', 'La cita no existe');
        }

    }
    
}
