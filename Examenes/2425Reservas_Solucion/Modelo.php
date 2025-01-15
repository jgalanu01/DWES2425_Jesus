<?php
require_once 'Reservas.php';
require_once 'Usuarios.php';
require_once 'Recursos.php';

class Modelo
{
    private string $url = 'mysql:host=localhost;port=3306;dbname=reservas';
    private string $us = 'root';
    private string $ps = 'root';

    private $conexion = null;

    function __construct()
    {
        try {
            $this->conexion = new PDO($this->url, $this->us, $this->ps);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // Parte del Ejercicio 1 - Login: Autenticación de usuario
    function login($us, $ps)
    {
        $resultado = 0;
        try {
            // Consulta SQL para obtener el usuario con idRayuela y contraseña cifrada (sha2)
            $consulta = $this->conexion->prepare('SELECT * from usuarios where idRayuela=? and ps=sha2(?,512)');
            $params = array($us, $ps);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    // Si se encuentra un usuario, se crea un objeto de la clase Usuarios con los datos obtenidos
                    $resultado = new Usuarios($fila['idRayuela'], $fila['nombre'], $fila['activo'], $fila['numReservas']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;  // Retorna el objeto de Usuario si la autenticación es exitosa, o 0 si no lo es.
    }

    // Parte del Ejercicio 2 - Función para obtener el color de las reservas
    // No pertenece directamente al ejercicio 1, pero puede ser utilizada para gestionar la preferencia del color
    function obtenerColorReserva($idUsuario)
    {
        $resultado = '';
        try {
            // Consulta SQL para obtener el color de las reservas del usuario
            $consulta = $this->conexion->prepare('SELECT colorReserva from usuarios where idRayuela=?');
            $params = array($idUsuario);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    // Si se encuentra el color, se retorna el valor
                    $resultado = $fila['colorReserva'];
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;  // Retorna el color de reserva del usuario, si existe.
    }

    // Parte del Ejercicio 2 - Actualización del color de las reservas del usuario
    function actualizarColorReserva($idUsuario, $color)
    {
        $resultado = false;
        try {
            // Actualiza el color de las reservas del usuario en la base de datos
            $consulta = $this->conexion->prepare('UPDATE usuarios SET colorReserva=? WHERE idRayuela=?');
            $params = array($color, $idUsuario);
            if ($consulta->execute($params)) {
                $resultado = true;  // Retorna true si se ha actualizado correctamente.
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    // Método adicional: Obtener detalles de un usuario (no directamente del ejercicio 1 pero puede ser útil)
    function obtenerUsuario($us)
    {
        $resultado = 0;
        try {
            // Consulta SQL para obtener los datos del usuario por idRayuela
            $consulta = $this->conexion->prepare('SELECT * from usuarios where idRayuela=?');
            $params = array($us);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    // Crea un objeto Usuario con los datos del usuario encontrado
                    $resultado = new Usuarios($fila['idRayuela'], $fila['nombre'], $fila['activo'], $fila['numReservas']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;  // Retorna el objeto Usuario con la información del usuario.
    }

    // Método que no está relacionado directamente con el ejercicio 1 pero que permite cambiar la contraseña
    function cambiarPS($id, $ps)
    {
        $resultado = false;
        try {
            // Consulta para actualizar la contraseña del usuario
            $consulta = $this->conexion->prepare('UPDATE usuarios set ps=? and cambiar=false');
            $params = array($ps);
            if ($consulta->execute($params)) {
                $resultado = true;  // Devuelve true si la contraseña fue cambiada con éxito.
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    // Parte que no está relacionada con el Ejercicio 1 - Métodos para gestionar recursos y reservas
    function obtenerRecursos()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from recursos');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Recursos($fila['id'], $fila['nombre'], $fila['tipo'], $fila['descripcion']);
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;  // Retorna un array con los objetos Recursos.
    }

    // Métodos para obtener reservas activas y gestionar las reservas (no están en el ejercicio 1, pero son funcionales)
    function obtenerReservasActivas($idR)
    {
        $resultado = array();
        try {
            // Parte del Ejercicio 3 - Obtener reservas activas de un recurso específico
            // Consulta SQL que obtiene las reservas activas de un recurso determinado, ordenadas por fecha de forma descendente
            // Las reservas son obtenidas junto con los detalles del usuario que hizo la reserva y el recurso reservado.
            $consulta = $this->conexion->prepare('SELECT * from reservas r 
                                                    inner join usuarios u on r.usuario = u.idRayuela
                                                    inner join recursos re on re.id=r.recurso and anulada = false 
                                                    where recurso = ?
                                                    order by r.fecha desc');
            $params = array($idR);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    // Se construye un objeto Reserva con los detalles de la reserva obtenida
                    $resultado[] = new Reservas(
                        $fila['0'],
                        new Usuarios($fila['idRayuela'], $fila['7'], $fila['activo'], $fila['numReservas']),
                        new Recursos($fila['recurso'], $fila['12'], $fila['tipo'], $fila['descripcion']),
                        date('d/m/Y', strtotime($fila['fecha'])),
                        $fila['hora']
                    );
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado; // Retorna un array con las reservas activas ordenadas por fecha.
    }

    // Parte del Ejercicio 4 - Verificar la disponibilidad de un recurso para una fecha y hora específicas
    // Esta función comprueba si un recurso está disponible para la fecha y hora indicadas usando la función almacenada 'disponibilidad'
    // Devuelve true si es posible reservar el recurso, de lo contrario, devuelve false.
    function chequearReservar($recurso, $fecha, $hora)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('SELECT disponibilidad(?,?,?)');
            $params = array($recurso, $fecha, $hora);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch() and $fila[0]) {
                    $resultado = true; // Si la función almacenada devuelve 1, la reserva es posible.
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $resultado;
    }

    // Parte del Ejercicio 4 - Realizar una reserva
    // Este método realiza una reserva para un recurso, usuario, fecha y hora determinados.
    // Primero, comienza una transacción. Si la reserva se realiza correctamente, se actualiza el número de reservas del usuario.
    // Si todo sale bien, se confirma la transacción, de lo contrario, se deshace.
    function reservar($recurso, $usuario, $fecha, $hora)
    {
        $resultado = false;
        try {
            $this->conexion->beginTransaction();
            // Realizar la inserción de la nueva reserva
            $consulta = $this->conexion->prepare('INSERT into reservas values
                (null,?,?,?,?,false)');
            $params = array($usuario, $recurso, $fecha, $hora);
            if ($consulta->execute($params)) {
                // Verificar que se insertó una fila
                if ($consulta->rowCount() == 1) {
                    // Actualizar el número de reservas del usuario
                    $consulta = $this->conexion->prepare('UPDATE usuarios set numReservas=numReservas+1 
                     where idRayuela = ?');
                    $params = array($usuario);
                    if ($consulta->execute($params) and $consulta->rowCount() == 1) {
                        $this->conexion->commit();
                        $resultado = true;
                    } else {
                        $this->conexion->rollBack(); // Deshacer el insert si no se pudo actualizar el usuario
                    }
                }
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // Parte del Ejercicio 5 - Anular una reserva y actualizar el número de reservas del usuario
    // Este método permite anular una reserva para un recurso, fecha y hora específicos. 
    // Se asegura de que el número de reservas del usuario se decremente correctamente.
    // La transacción se confirma si todo el proceso se realiza con éxito, de lo contrario, se revierte.
    function anularReserva($recurso, $usuario, $fecha, $hora)
    {
        $resultado = false;
        try {
            $this->conexion->beginTransaction();
            // Anular la reserva
            $consulta = $this->conexion->prepare('UPDATE reservas set anulada = true 
            where usuario=? and recurso=? and fecha=? and hora=? and anulada=false');
            $params = array($usuario, $recurso, $fecha, $hora);
            if ($consulta->execute($params)) {
                // Verificar que se anuló la reserva
                if ($consulta->rowCount() == 1) {
                    // Actualizar el número de reservas del usuario
                    $consulta = $this->conexion->prepare('UPDATE usuarios set numReservas=numReservas-1 
                     where idRayuela = ?');
                    $params = array($usuario);
                    if ($consulta->execute($params) and $consulta->rowCount() == 1) {
                        $this->conexion->commit();
                        $resultado = true;
                    } else {
                        $this->conexion->rollBack(); // Deshacer el update si no se pudo actualizar el usuario
                    }
                }
            }
        } catch (PDOException $e) {
            $this->conexion->rollBack();
            echo $e->getMessage();
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }
}
