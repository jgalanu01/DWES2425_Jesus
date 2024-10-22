<?php
require_once 'Modelo.php';
session_start();

//Si no hay sesión iniciada, redirigimos a login 

if(!isset($_SESSION['usuario'])){
    header('location:login.php');
}


if(isset($_POST['cerrar'])){
    session_destroy();
    header('location:login.php');

}

//Creamos objeto de acceso a la BD

$bd=new Modelo();

if(isset($_POST['pCrear'])){  //Porque he pulsado en el crear de préstamo
//Creamos un préstamo 
//Usamos la función de la bd comprobarSiPrestar(pSocio int pLibro int) (está creado en la bd), para ver si se puede hacer el préstamo

$resultado=$bd->comprobar($_POST['socio'],$_POST['libro']);

if($resultado=='ok'){
    //Hacer el préstamo

    $error='Se puede prestar';

}
else{
    $error = $resultado;
}
}


?>