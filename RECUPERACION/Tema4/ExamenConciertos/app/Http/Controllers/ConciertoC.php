<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConciertoC extends Controller
{
    function inicioM(){
        return 'pagina de inicio';
    }

    function entradasM($idConcierto){
        return 'pagina entradas del concierto '.$idConcierto;
    }

    function venderM($idConcierto){
        return 'pagina de ventas';
    }

    function borrarM($idConcierto){
        return 'borrar';
    }
}
