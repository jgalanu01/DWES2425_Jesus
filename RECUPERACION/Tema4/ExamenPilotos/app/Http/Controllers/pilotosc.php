<?php

namespace App\Http\Controllers;

use App\Models\Piloto;
use Exception;
use Illuminate\Http\Request;

class pilotosc extends Controller
{
    function inicioM(){
        $pilotos=Piloto::all();

        return view('vistaInicio',compact('pilotos'));
    }

    function crearPilotoM(Request $request){
        $request->validate(["nombre"=>"required","nacionalidad"=>"required","escuderia"=>"required"]);

        try {
           $piloto=new Piloto();
           $piloto->nombre=$request->nombre;
           $piloto->nacionalidad=$request->nacionalidad;
           $piloto->escuderia=$request->escuderia;

           if($piloto->save()){
            return back()->with('info','Piloto guardado correctamente');
           }else{
            throw new Exception ('No se ha podido guardar el piloto');
           }
        } catch (\Throwable $th) {
            return back()->with('mensaje',$th->getMessage());
        }
    }

    function modificarPilotoM($id){
        $piloto=Piloto::find($id);

        return view('modificarPiloto',compact('piloto'));

    }

    function actualizarPilotoM(Request $request,$id){
        $piloto=Piloto::find($id);

        $request->validate(["nombre"=>"required","nacionalidad"=>"required","escuderia"=>"required"]);

        try {
            $piloto->nombre=$request->nombre;
            $piloto->nacionalidad=$request->nacionalidad;
            $piloto->escuderia=$request->escuderia;
 
            if($piloto->save()){
             return back()->with('info','Piloto guardado correctamente');
            }else{
             throw new Exception ('No se ha podido guardar el piloto');
            }
         } catch (\Throwable $th) {
             return back()->with('mensaje',$th->getMessage());
         }


         
    }
    function borrarPilotoM ($id){
        $piloto=Piloto::find($id);

        try {

            if($piloto->delete()){
                return back()->with('info','Piloto borrado correctamente');
            }else{
                throw new Exception('No se ha podido borrar el piloto');
            }
            
        } catch (\Throwable $th) {
            return back()->with('mensaje',$th->getMessage());
         
        }
     }
}
