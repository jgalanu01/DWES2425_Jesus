<?php
require_once 'Modelo.php';

session_start();
$bd=new Modelo();  //bd es de tipo Modelo


//Ej1.Ver si se ha pulsado en acceder

if(isset($_POST['acceder'])){
    //Chequear si viene relleno usuario y contraseña
    if(empty($_POST['usuario']) || empty($_POST['ps'])){
       $mensaje='Usuario o contraseña obligatorias'; //Creada en Modelo la variable mensaje
    }else{
      $us=$bd->obtenerUsuario($_POST['usuario'],$_POST['ps']); //Creamos obtenerUsuario en modelo, parametros de usuario y contraseña
      //Comprobar si el usuario existe 

      if($us!=null){
        
        //Guardar el usuario en la sesión 
        $_SESSION['usuario']=$us;
        header('location:index.php');

      }

    }
}




?>