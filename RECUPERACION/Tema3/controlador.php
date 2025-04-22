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

      if($us!=null and $us->getActivo()){ //Que usuario no sea nulo y activo sea true, lo pone en el examen 
        //Guardar el usuario en la sesión 
        $_SESSION['usuario']=$us;
        header('location:index.php');

      }else{
        $mensaje='Usuario o contraseña incorrecto';
      }

    }

    //2.Ejercicio
}elseif(isset($_POST['salir'])){
  session_destroy();
  setcookie('color','',time()-1); //La caducamos para que al cerrar sesion desaparezca si hay un color seleccionado 
  header('location:index.php');

}elseif(isset($_POST['cambiarColor'])){
  setcookie('color',$_POST['color']); //el segundo parámetro, color es como se llama en el input, y el primer parametro color es como yo quiero llamar a la cookie.
  header('location:index.php');

}




?>