<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginC extends Controller
{
    function vistaLogin(){
       return view('usuarios/login'); //Ruta usuarios/login.blade.php

    }
    function loguear(){
        echo 'proceso de logueo';
        
    }
    function vistaRegistro(){
       return view ('usuarios/registro');  //Ruta usuarios/registro.blade.php
        
    }
    function registrar(){
    
        
    }
    function cerrarSesion(){
        echo 'Cerrar sesion';
        
    }

}
