<?php
require_once 'Modelo.php';

session_start();

$bd=new Modelo();

if($bd->getConexion()==null){
    $mensaje='Error, no hay conexión';

}

if(isset($_POST['iniciar'])){
    $l=$bd->obtenerLinea($_POST['linea']);
    $c=$bd->obtenerConductor($_POST['conductor']);
    if($s!=null and $c!=null){
        $_SESSION['linea']=$l;
        $_session['conductor']=$c;

        header('location:index.php');
    }
    else{
        $mensaje='No existe línea ni conductor';
    }
}

elseif(isset($_POST['fin'])){
    if($bd->fin($_POST['conductor'])){
        $mensaje='Servicio borrado';
    }
    else{
        $mensaje='Error al borrar el servicio';
    }

        
    }


?>

