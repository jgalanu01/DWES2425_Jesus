<?php

namespace App\Http\Controllers;

use App\Models\Billete;
use App\Models\Conductor;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class ConductorC extends Controller
{
    public function identificarConductor(){
        try {
           $conductor=Conductor::all();
           return view('conductor',compact('conductor'));

        } catch (\Throwable $th) {
           return back()->with('mensaje',$th->getMessage());
        }
    }

    public function comprobarDni(Request $request){

        try{
            $conductor=Conductor::find($request->conductor);
            $servicios=Servicio::find($request->servicios);
            if($conductor!=null){
                return view('servicios', compact('conductor'));

            }else{
                return back()->with('mensaje','Error, el conductor no existe');
            }

        }catch(\Throwable $th){
            return back()->with('mensaje',$th->getMessage());

        }

    }


    public function registrarBillete(Request $request, $id){
        $request->validate(
            [
            'hora'=>'required',
            'Precio'=>'required',
            'Anulado'=>'required',


            ]

            );
        try {
           $billete=Billete::find($id);
           DB::transaction(
            function () use ($request, $id,$billete){
                $billete=new BIllete();
                $billete->servicio_id=$billete->id;
                $billete->hora=$request->hora;
                $billete->precio=$request->precio;
                $billete->anulado=$request->anulado;
                $billete->save();

            }
        );

        return back()->with('mensaje', 'Billete registrada');

        } catch (\Throwable $th) {

            return back()->with('mensaje', $th->getMessage());
           
        }
    }
}
