<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReproduccionR;
use App\Models\Cliente;
use App\Models\Contenido;
use App\Models\Reproduccion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ClienteController extends Controller
{
    
    public function reproducir(Request $request){
        $request->validate([
                'email'=>'required',
                'idC' =>'required'
            ]);
        try {
            $cli = Cliente::where('email',$request->email)->first();
            if($cli!=null){
                $con = Contenido::find($request->idC);
                if($con!=null){
                    $r = new Reproduccion();
                    $r->cliente_id=$cli->id;
                    $r->contenido_id=$con->id;
                    $r->fechaIR=date('Y-m-d H:i');
                    if($r->save()){
                        return $r;
                    }
                }
                else{
                    throw new Exception('Contenido no existe');
                }
            }
            else{
                throw new Exception('Cliente no existe');
            }

        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()],500);
        }
    }
    public function obtenerReproducciones(Request $request){
        $request->validate([
                'email'=>'required'
            ]);
        try {
            $c = Cliente::where('email',$request->email)->first();
            if($c!=null){
                return ReproduccionR::collection($c->reproducciones());
            }
            else{
                throw new Exception('Cliente no existe');
            }

        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()],500);
        }
    }
}
