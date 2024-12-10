<?php
require_once 'Modelo.php'; // (Ejercicio 1) Incluir el modelo para manejar la base de datos
session_start();

$bd = new Modelo(); // (Ejercicio 1) Crear instancia del modelo

if ($bd->getConexion() == null) {
    // (Ejercicio 1) Mostrar mensaje de error si no hay conexión con la base de datos
    $error = 'Error, no hay conexión con la BD';
}

// (Ejercicio 1) Obtener las modalidades disponibles
$mod = $bd->obtenerModalidades();

if (isset($_POST['selModalidad'])) {
    // (Ejercicio 1) Manejar la selección de modalidad
    if (!empty($_POST['modalidad'])) {
        $m = $bd->obtenerModalidad($_POST['modalidad']);
        if ($m != null) {
            // (Ejercicio 1) Guardar la modalidad seleccionada en la sesión
            $_SESSION['mod'] = $m;
        } else {
            $error = 'Error, no se puede obtener la modalidad';
        }
    }
} elseif (isset($_POST['selAlumno'])) {
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
} elseif (isset($_POST['cambiarM'])) {
    // (Ejercicio 3) Cambiar la modalidad seleccionada
    session_destroy(); // Eliminar toda la información de la sesión
    header('location:skills.php'); // Recargar la página
} elseif (isset($_POST['cambiarA'])) {
    // (Ejercicio 3) Cambiar el alumno seleccionado
    unset($_SESSION['alumno']); // Eliminar la información del alumno de la sesión
    header('location:skills.php'); // Recargar la página
} elseif (isset($_POST['guardar'])) {
    // (Ejercicio 4) Guardar la corrección de una prueba
    $p = $bd->obtenerPrueba($_POST['prueba']); // Obtener la prueba seleccionada
    if ($_POST['puntos'] > $p->getPuntuacion()) {
        // (Ejercicio 4) Validar que los puntos no superen los máximos de la prueba
        $error = 'Error, no puede superar la puntuación máxima';
    } else {
        $c = $bd->obtenerCorrecion($_POST['prueba'], $_SESSION['alumno']->getId());
        if ($c != null) {
            // (Ejercicio 4) Validar que la prueba no haya sido corregida anteriormente
            $error = 'Error, la prueba ya está corregida';
        } else {
            if ($bd->crearCorreccion($_POST['prueba'], $_SESSION['alumno']->getId(), $_POST['puntos'], $_POST['comentario'])) {
                // (Ejercicio 4) Mensaje de éxito al guardar la corrección
                $error = 'Calificación creada y puntuación del alumno actualizada';
                // (Ejercicio 4) Actualizar los datos del alumno en la sesión
                $_SESSION['alumno'] = $bd->obtenerAlumno($_SESSION['alumno']->getId());
            } else {
                $error = 'Error, no se ha creado la calificación';
            }
        }
    }
} elseif (isset($_POST['finalizar'])) {
    // (Ejercicio 5) Finalizar la corrección del alumno
    if (!$_SESSION['alumno']->getFinalizado()) {
        // (Ejercicio 5) Validar si se han corregido todas las pruebas del alumno
        $c = $bd->obtenerCalificaciones($_SESSION['alumno']->getId()); // Correcciones realizadas
        $p = $bd->obtenerPruebasModalidad($_SESSION['mod']->getId()); // Total de pruebas
        if (sizeof($c) == sizeof($p)) {
            if ($bd->finalizarCorreccion($_SESSION['alumno']->getId())) {
                // (Ejercicio 5) Mensaje de éxito al finalizar la corrección
                $error = 'Corrección finalizada';
                // (Ejercicio 5) Actualizar los datos del alumno en la sesión
                $_SESSION['alumno'] = $bd->obtenerAlumno($_SESSION['alumno']->getId());
            }
        } else {
            // (Ejercicio 5) Mostrar error si no se han corregido todas las pruebas
            $error = 'Error, no se han corregido todas las pruebas. Nº de pruebas de la modalidad: ' . sizeof($p) . ' y nº de pruebas corregidas: ' . sizeof($c);
        }
    } else {
        // (Ejercicio 5) Mensaje de error si la corrección ya fue finalizada
        $error = 'Error, ya se ha finalizado la corrección del alumno';
    }
}
