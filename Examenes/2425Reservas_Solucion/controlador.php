<?php
require_once 'Modelo.php';
session_start();

$bd = new Modelo();

if (isset($_POST['acceder'])) {
    // Parte del Ejercicio 1 - Verificación de login
    if (empty($_POST['usuario']) or empty($_POST['ps'])) {
        // Si alguno de los campos está vacío, se muestra un mensaje de error
        $mensaje = 'Error, rellena usuario y contraseña';
    } else {
        // Se llama al método 'login' del modelo para intentar autenticar al usuario
        $u = $bd->login($_POST['usuario'], $_POST['ps']);
        if ($u == null) {
            // Si no se encuentra un usuario con esos datos, muestra un mensaje de error
            $mensaje = 'Error, datos incorrectos';
        } else {
            // Si el usuario está inactivo, también se muestra un mensaje de error
            if (!$u->getActivo()) {
                $mensaje = 'Error, datos incorrectos';
            } else {
                // Si todo es correcto, se guarda al usuario en la sesión
                $_SESSION['usuario'] = $u;
            }
        }
    }
} elseif (isset($_POST['salir'])) {
    // Parte del Ejercicio 2 - Cierre de sesión
    session_destroy();
    header('location:index.php');
} elseif (isset($_POST['cambiarColor'])) {
    // Parte del Ejercicio 2 - Código relacionado con la gestión de colores
    // El color de la reserva del usuario se guarda en una cookie para su persistencia
    setcookie('colorR', $_POST['color']);
    header('location:index.php');
} elseif (isset($_POST['reservar'])) {
    // Parte del Ejercicio 4 - Crear Reserva
    // Comprobación de que la fecha y la hora no están vacíos
    if (empty($_POST) or empty($_POST['fecha']) or empty($_POST['hora'])) {
        $mensaje = 'Rellena todos los datos';
    } else {
        // Verifica la disponibilidad del recurso antes de realizar la reserva
        if ($bd->chequearReservar($_POST['recurso'], $_POST['fecha'], $_POST['hora'])) {
            // Si el recurso está disponible, se realiza la reserva
            if ($bd->reservar($_POST['recurso'], $_SESSION['usuario']->getIdRayuela(), $_POST['fecha'], $_POST['hora'])) {
                $mensaje = 'Reserva realizada';
                $_SESSION['usuario'] = $bd->obtenerUsuario($_SESSION['usuario']->getIdRayuela());
            } else {
                // Si no se pudo realizar la reserva
                $mensaje = 'Error, no se ha realizado la reserva';
            }
        } else {
            // Si el recurso ya está asignado en la fecha y hora seleccionadas
            $mensaje = 'Error, recurso ya está asignado';
        }
    }
} elseif (isset($_POST['anular'])) {
    // Parte del Ejercicio 5 - Anular una reserva
    // Comprobación de que la fecha y la hora no están vacíos antes de intentar anular la reserva
    if (empty($_POST) or empty($_POST['fecha']) or empty($_POST['hora'])) {
        $mensaje = 'Rellena todos los datos';
    } else {
        // Llamada al modelo para anular la reserva
        if ($bd->anularReserva($_POST['recurso'], $_SESSION['usuario']->getIdRayuela(), $_POST['fecha'], $_POST['hora'])) {
            // Si la reserva se anuló correctamente
            $mensaje = 'Reserva anulada';
            // Actualización de la información del usuario en la sesión para reflejar el cambio en el número de reservas
            $_SESSION['usuario'] = $bd->obtenerUsuario($_SESSION['usuario']->getIdRayuela());
        } else {
            // Si no se pudo anular la reserva
            $mensaje = 'Error, no se ha anulado la reserva';
        }
    }
} elseif (isset($_POST['verR'])) {
    // Parte del Ejercicio 3 - Ver reservas de un recurso seleccionado
    if (!empty($_POST['recurso'])) {
        // Se obtiene el recurso seleccionado
        $reservas = $bd->obtenerReservasActivas($_POST['recurso']);

        // Al mostrar las reservas, se ordenan de forma descendente por fecha
        // Se resalta el color de las reservas del usuario logueado, basado en la cookie (si existe)
        // Si no hay color, se utiliza el color negro por defecto
        foreach ($reservas as $r) {
            if ($r->getUsuario()->getIdRayuela() == $_SESSION['usuario']->getIdRayuela()) {
                echo '<tr style="color:' . (isset($_COOKIE['colorR']) ? $_COOKIE['colorR'] : 'black') . '">'; // Color de las reservas basado en la cookie
            } else {
                echo '<tr>';
            }
            echo '<td>' . $r->getId() . '</td>';
            echo '<td>' . $r->getUsuario()->getNombre() . '</td>';
            echo '<td>' . $r->getRecurso()->getNombre() . '</td>';
            echo '<td>' . $r->getFecha() . '</td>';
            echo '<td>' . $r->getHora() . '</td>';
            echo '</tr>';
        }
    }
}
