<?php 

require_once 'Modelo.php';

session_start();

$bd = new Modelo();

if ($bd->getConexion() == null) {
  $mensaje = 'Error en la conexión con la base de datos';
}

if(isset($_POST['carrera'])){
  $piloto=$bd->obtenerPiloto($_POST['piloto']);

  if($piloto){
    $_SESSION['piloto']=$piloto;
    header('location:Carrera.php');
  }else{
    $mensaje = 'El Piloto no existe';
    
  }
}

if(isset($_POST['crear'])){
  if($vueltas=$bd->insertarVuelta($_SESSION['piloto'],$_POST['tiempo'])){
    $info='Vuelta insertada correctamente';
  }else{
    $mensaje='La vuelta no ha podido introducirse';
  }
}else if(isset($_POST['salir'])){
  session_destroy();
  header('location:Index.php');

}

if(isset($_POST['anular'])){
  if($vueltas=$bd->anularVuelta($_POST['anular'])){
    $info='Vuelta anulada correctamente';
  }else{
    $mensaje='No se ha podido anular la vuelta';
  }
}

if(isset($_POST['borrar'])){
  if($borrado=$bd->borrarVuelta($_POST['borrar'])){
    $info='Vuelta borrada correctamente';
  }else{
    $mensaje='No se ha podido borrar la vuelta';
  }
}





?>