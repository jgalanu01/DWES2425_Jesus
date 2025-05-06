<?php

namespace App\Http\Controllers;

use App\Models\Concierto;
use Illuminate\Http\Request;

class ConciertoC extends Controller
{
    function inicioM(){
        $conciertos=Concierto::orderBy('titulo')->get(); //Hace un SELECT * FROM CONCIERTO order by titulo , siempre que no sea un all 
                                                         //o un find hay que poner ->get y lo devuelve ordenado 
        //return view('vistaInicio',['c'=>$conciertos]);
        return view('vistaInicio',compact('conciertos')); //Con compact el array asociativo al campo se le llama igual, en este caso conciertos 
    }

     //Aquí es cuando hay que pasar el concierto que recibe del formulario de vistaIniciobladey se pasa el parametro que quitamos del 
     //route para ponerlo con el request(el request son todos los datos que llegan del formulario)
    function entradasM(Request $r){

        //Obtenemos los datos del concierto

        $concierto=Concierto::find($r->conc); //Ese conc en $r->conc es el del name 

        if($concierto==null){
            return 'El concierto no existe.';
        }
       
        return view('vistaEntrada',compact('concierto'));

    }

    function venderM(Request $r,$idConcierto){ //Necesito datos del formulario, por eso pongo Request
        return 'pagina de ventas';
    }

    function borrarM($idConcierto){
        return 'borrar';
    }
}
