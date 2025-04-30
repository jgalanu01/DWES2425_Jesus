<?php

require_once 'Modelo.php';
session_start();

$bd = new Modelo();  //bd es de tipo Modelo


//Ej1.Ver si se ha pulsado en acceder

if (isset($_POST['acceder'])) {
  //Chequear si viene relleno usuario y contraseña
  if (empty($_POST['usuario']) || empty($_POST['ps'])) {
    $mensaje = 'Usuario o contraseña obligatorias'; //Creada en Modelo la variable mensaje
  } else {
    $us = $bd->obtenerUsuario($_POST['usuario'], $_POST['ps']); //Creamos obtenerUsuario en modelo, parametros de usuario y contraseña
    //Comprobar si el usuario existe 

    if ($us != null and $us->getActivo()) { //Que usuario no sea nulo y activo sea true, lo pone en el examen 
      //Guardar el usuario en la sesión 
      $_SESSION['usuario'] = $us;
      header('location:index.php');
    } else {
      $mensaje = 'Usuario o contraseña incorrecto';
    }
  }

  //2.Ejercicio
} elseif (isset($_POST['salir'])) {
  session_destroy();
  setcookie('color', '', time() - 1); //La caducamos para que al cerrar sesion desaparezca si hay un color seleccionado 
  header('location:index.php');
} elseif (isset($_POST['cambiarColor'])) {
  setcookie('color', $_POST['color']); //el segundo parámetro, color es como se llama en el input, y el primer parametro color es como yo quiero llamar a la cookie.
  header('location:index.php');


  //Ejercicio 3. Ver las reservas
} elseif (isset($_POST['verR'])) {
  $reservas = $bd->obtenerReservas($_POST['recurso']); //Quiero ver las reservas del recurso seleccionado

  //Ejercicio 4. comprobar que no vengan vacios recurso fecha y hora y hacer reserva

} elseif (isset($_POST['reservar'])) {
  if (empty($_POST['fecha']) || empty($_POST['recurso']) || empty($_POST['hora'])) {
    $mensaje = 'Deben estar rellenos los campos';
  } else {
    //Comprobar con la funcion amacenada en bd si esta disponible la reserva
    if ($bd->verificarDisponibilidad($_POST['recurso'], $_POST['fecha'], $_POST['hora'])) {
      //si esto ya es true se hace la reserva porque verificar disponibilidad nos ha dicho que está disponible (true)
      $r = new Reservas(null, $_SESSION['usuario']->getIdRayuela(), $_POST['recurso'], $_POST['fecha'], $_POST['hora'], false);

      if ($bd->guardarReserva($r)) { //Devuelve true si ha ido bien y false si ha ido mal
        $mensaje = 'Reserva guardada correctamente';
        //Actualizar el usuario en la sesión al haber guardado la reserva
        $_SESSION['usuario'] = $bd->infoUsuario($_SESSION['usuario']->getIdRayuela());
      } else {
        $mensaje = 'Error no se ha podido guardar';
      }
    } else {
      $mensaje = 'Error no se puede reservar';
    }
  }

  //Ejercicio 5. Anular y chequear que el recurso la fecha y la hora no están vacíos
} elseif (isset($_POST['anular'])) {
  if (empty($_POST['fecha']) || empty($_POST['recurso']) || empty($_POST['hora'])) {
    $mensaje = 'Deben estar rellenos los campos';
  } else {
    if ($bd->anularReserva($_SESSION['usuario']->getIdrayuela(), $_POST['recurso'], $_POST['fecha'], $_POST['hora'])){
    $mensaje = 'Reserva anulada correctamente';
    //Actualizar el usuario en la sesión al haber anulado la reserva
    $_SESSION['usuario'] = $bd->infoUsuario($_SESSION['usuario']->getIdRayuela());
    }else{
      $mensaje='Error, no se ha podido anular';
    }
  }
}
