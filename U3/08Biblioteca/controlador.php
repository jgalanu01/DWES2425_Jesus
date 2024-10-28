<?php
require_once 'Modelo.php';
session_start();

//Si no hay sesión iniciada, redirigimos a login 

if (!isset($_SESSION['usuario'])) {
    header('location:login.php');
}


if (isset($_POST['cerrar'])) {
    session_destroy();
    header('location:login.php');
}

//Creamos objeto de acceso a la BD

$bd = new Modelo();

if (isset($_POST['pCrear']) and $_SESSION['usuario']->getTipo() == 'A') {  //Porque he pulsado en el crear de préstamo
    //Creamos un préstamo 
    //Usamos la función de la bd comprobarSiPrestar(pSocio int pLibro int) (está creado en la bd), para ver si se puede hacer el préstamo

    $resultado = $bd->comprobar($_POST['socio'], $_POST['libro']);

    if ($resultado == 'ok') {
        //Hacer el préstamo, habra que hacer un insert para añadir el préstamo y un update para decir que hay un libro menos en la biblitoeca, porque está prestado
        $resultado = $bd->crearPrestamo($_POST['socio'], $_POST['libro']);
        if ($resultado == 'ok') {
            //Hacer el préstamo

            $numero = $bd->crearPrestamo($_POST['socio'], $_POST['libro']);
            if ($numero > 0) {
                $mensaje = 'Préstamo nº' . $numero . 'Registrado';
            } else {


                $error = 'Se ha producido un error al crear el préstamo';
            }
        }
    } else {
        $error = $resultado;
    }
    
}
elseif (isset($_POST['pDevolver']) and $_SESSION['usuario']->getTipo() == 'A') {
    //Obtener el préstamo 
    $p = $bd->obtenerPrestamo($_POST['pDevolver']);
    if ($p != null) {

        //Chequear si hay que sancionar al socio 
        $sancion = false;
        if (strtotime($p->getFechaD()) < strtotime(date('Y-m-d'))) {
            $sancion = true;
        }

        if ($bd->devolverPrestamo($p, $sancion)) {
            $mensaje = 'Préstamo devuelto';
            if ($sancion) {
                $mensaje.= 'Se ha sancionado al socio';
            }
        } else {
            $error = 'Error, al devolver el préstamo';
        }
    } else {
        $error = 'Préstamo no existe';
    }
}
?>
