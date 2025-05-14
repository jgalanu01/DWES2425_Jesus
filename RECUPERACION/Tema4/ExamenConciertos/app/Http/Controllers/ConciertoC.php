<?php

namespace App\Http\Controllers;

use App\Models\Concierto;
use App\Models\Entrada;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConciertoC extends Controller
{
    function inicioM()
    {
        $conciertos = Concierto::orderBy('titulo')->get(); //Hace un SELECT * FROM CONCIERTO order by titulo , siempre que no sea un all 
        //o un find hay que poner ->get y lo devuelve ordenado 
        //return view('vistaInicio',['c'=>$conciertos]);
        return view('vistaInicio', compact('conciertos')); //Con compact el array asociativo al campo se le llama igual, en este caso conciertos 
    }

    //Aquí es cuando hay que pasar el concierto que recibe del formulario de vistaIniciobladey se pasa el parametro que quitamos del 
    //route para ponerlo con el request(el request son todos los datos que llegan del formulario)
    function entradasM(Request $r)
    {

        //Obtenemos los datos del concierto

        $concierto = Concierto::find($r->conc); //Ese conc en $r->conc es el del name 

        if ($concierto == null) {
            return 'El concierto no existe.';
        }

        return view('vistaEntrada', compact('concierto'));
    }

    function venderM(Request $r, $idConcierto)
    { //Necesito datos del formulario, por eso pongo Request
        $r->validate(['email' => 'required', 'numEntradas' => 'required|numeric|min:1|max:4']);

        try {
            //Chequear que hay entradas suficientes, lo pide en el examen.El concierto va en la ruta con el idconcierto.
            $c = Concierto::find($idConcierto);

            if ($c == null) {
                throw new Exception('Concierto no existe');
            }
            if ($c->aforo < $r->numEntradas) {
                throw new Exception('No hay aforo suficiente');
            }

            //Hacemos una transacción que cree la venta y actualice el aforo(tiene que ser aforo-ventas).
            DB::transaction(function () use ($r, $c) { //En el use se pasa lo que voy a utilizar, todo el request, vamos a pasar, porque no pasaria nada y el concierto $c
                //Crear la entrada
                $e = new Entrada();
                $e->email = $r->email;
                $e->concierto_id = $c->id; //El concierto no viene del request
                $e->numEntradas = $r->numEntradas;
                $e->save(); //insert

                //Update de aforo del concierto

                $c->aforo -= $r->numEntradas;
                $c->save(); //update
            });
        } catch (\Throwable $th) {

            return back()->with('mensaje', $th->getMessage());
        }

        return back()->with('info', 'Se ha comprado la entrada con éxito');
    }

    function borrarM($idConcierto)
    {

        try {
            $concierto = Concierto::find($idConcierto);
            if ($concierto != null) {
                //Si no hay entradas borra el concierto, si las hay primero las entradas y luego el concierto.
                //Llamamos al metodo del has many
                $entradas = $concierto->entradas();
                if (empty($entradas)) {
                    $concierto->delete();
                } else {
                    DB::transaction(function () use ($concierto, $entradas) {
                        foreach ($entradas as $e) {
                            $e->delete();
                        }

                        $concierto->delete();
                    });
                }
            } else {
                throw new Exception('No existe el concierto');
            }
        } catch (\Throwable $th) {
            return back()->with('mensaje', $th->getMessage());
        }
        return redirect()->route('rInicio')->with('mensaje','Concierto Borrado');  //Creamos otra variable mensaje en vista inicio para que nos muestre mensaje al borrar
    }
}
