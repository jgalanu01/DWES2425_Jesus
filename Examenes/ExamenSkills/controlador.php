<?php
require_once 'Modelo.php'; // (Ejercicio 1) Incluir el modelo para manejar la base de datos
session_start();

$bd = new Modelo(); // (Ejercicio 1) Crear instancia del modelo

if ($bd->getConexion() == null) {
    // (Ejercicio 1) Mostrar error si no hay conexión con la base de datos
    $error = 'Error, no hay conexión con la BD';
} else {
    // (Ejercicio 1) Obtener las modalidades disponibles
    $mod = $bd->obtenerModalidades();

    // (Ejercicio 6) Obtener la lista de ganadores
    $ganadores = $bd->obtenerGanadores();
}

if (isset($_POST['selModalidad'])) {
    // (Ejercicio 1) Manejar la selección de modalidad
    if (!empty($_POST['modalidad'])) {
        $m = $bd->obtenerModalidad($_POST['modalidad']);
        if ($m != null) {
            // (Ejercicio 1) Guardar la modalidad seleccionada en la sesión
            $_SESSION['mod'] = $m;
        } else {
            $error = 'Error, no se puede obtener la modalidad seleccionada';
        }
    }
}

if (isset($_POST['selAlumno'])) {
    // (Ejercicio 2) Manejar la selección de alumno
    if (!empty($_POST['alumno'])) {
        $a = $bd->obtenerAlumno($_POST['alumno']);
        if ($a != null && $a->getModalidad() == $_SESSION['mod']->getId()) {
            // (Ejercicio 2) Guardar el alumno seleccionado en la sesión
            $_SESSION['alumno'] = $a;
        } else {
            $error = 'Error, no se puede seleccionar el alumno';
        }
    }
}

if (isset($_POST['cambiarA'])) {
    // (Ejercicio 3) Cambiar el alumno seleccionado
    unset($_SESSION['alumno']); // Eliminar la información del alumno de la sesión
    header('location:skills.php'); // Recargar la página
    exit;
}

if (isset($_POST['cambiarM'])) {
    // (Ejercicio 3) Cambiar la modalidad seleccionada
    unset($_SESSION['mod']); // Eliminar la modalidad de la sesión
    unset($_SESSION['alumno']); // Eliminar el alumno de la sesión
    header('location:skills.php'); // Recargar la página
    exit;
}

if (isset($_POST['guardar'])) {
    // (Ejercicio 4) Guardar la corrección de una prueba
    $prueba = $bd->obtenerPrueba($_POST['prueba']); // Obtener la prueba seleccionada
    $puntos = $_POST['puntos']; // Obtener los puntos introducidos por el usuario

    if ($puntos > $prueba->getPuntuacion()) {
        // (Ejercicio 4) Validar que los puntos no superen los máximos de la prueba
        $error = 'Error, los puntos no pueden superar los puntos máximos.';
    } else {
        $correccion = $bd->obtenerCorreccion($_SESSION['alumno']->getId(), $prueba->getId());
        if ($correccion != null) {
            // (Ejercicio 4) Validar que la prueba no haya sido corregida anteriormente
            $error = 'Error, la prueba ya ha sido corregida.';
        } else {
            // (Ejercicio 4) Guardar la corrección y actualizar la puntuación del alumno
            $bd->guardarCorreccion($_SESSION['alumno']->getId(), $prueba->getId(), $puntos, $_POST['comentario']);
        }
    }
}

if (isset($_POST['finalizar'])) {
    // (Ejercicio 5) Finalizar la corrección del alumno
    $pruebas = $bd->obtenerPruebasModalidad($_SESSION['mod']->getId()); // Obtener todas las pruebas de la modalidad
    $correcciones = $bd->obtenerCorreccionesAlumno($_SESSION['alumno']->getId()); // Obtener las correcciones realizadas

    if (count($pruebas) != count($correcciones)) {
        // (Ejercicio 5) Validar si se han corregido todas las pruebas
        $error = 'Error, no se han corregido todas las pruebas.';
    } else {
        // (Ejercicio 5) Marcar al alumno como finalizado
        $bd->finalizarAlumno($_SESSION['alumno']->getId());
        $_SESSION['alumno']->setFinalizado(true); // Actualizar el estado del alumno en la sesión
    }
}
