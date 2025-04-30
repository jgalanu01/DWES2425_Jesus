<?php
require_once 'Modelo.php';
session_start();

$bd = new Modelo();  //bd es de tipo Modelo

if (isset($_POST['iniciar'])) {
    $l = $bd->obtenerLinea($_POST['linea']);
    if ($l != null) {
        $c = $bd->obtenerConductor($_POST['conductor']);
        if ($c != null) {
            if ($bd->crearServicio($c, $l)) {
                $_SESSION['conductor'] = $c;
                $_SESSION['linea'] = $l;
                header('location:index.php');
            } else {
                $mensaje = "Error, no se ha creado el servicio";
            }
        } else {

            $mensaje = "No existe el conductor";
        }
    } else {
        $mensaje="No existe la linea";
    }
}
