<?php
require_once 'Modalidad.php'; // (Ejercicio 1) Manejar datos de la modalidad
require_once 'Alumno.php'; // (Ejercicio 2) Manejar datos del alumno
require_once 'Prueba.php'; // (Ejercicio 4) Manejar datos de las pruebas
require_once 'Correccion.php'; // (Ejercicio 4 y 5) Manejar datos de las correcciones

class Modelo
{
    private $conexion = null;

    function __construct()
    {
        try {
            // (Ejercicio 1) Establecer conexión con la base de datos
            $this->conexion = new PDO(
                'mysql:host=localhost;port=3306;dbname=skills',
                'root',
                'root'
            );
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    // (Ejercicio 1) Obtener todas las modalidades
    function obtenerModalidades()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from modalidad');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Modalidad($fila['id'], $fila['modalidad']);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 1) Obtener una modalidad específica
    function obtenerModalidad($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from modalidad where id = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Modalidad($fila['id'], $fila['modalidad']);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 2) Obtener los alumnos de una modalidad específica
    function obtenerAlumnosModalidad($id)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from alumno where modalidad = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Alumno(
                        $fila['id'],
                        $fila['nombre'],
                        $fila['modalidad'],
                        $fila['puntuacion'],
                        $fila['finalizado']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 2) Obtener un alumno específico
    function obtenerAlumno($id)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from alumno where id = ?');
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Alumno(
                        $fila['id'],
                        $fila['nombre'],
                        $fila['modalidad'],
                        $fila['puntuacion'],
                        $fila['finalizado']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Obtener todas las pruebas de una modalidad específica
    function obtenerPruebasModalidad($idM)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('SELECT * from prueba where modalidad = ?');
            $params = array($idM);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Prueba(
                        $fila['id'],
                        $fila['modalidad'],
                        $fila['fecha'],
                        $fila['descripcion'],
                        $fila['puntuacion']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Obtener una prueba específica
    function obtenerPrueba($idPrueba)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from prueba where id = ?');
            $params = array($idPrueba);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Prueba(
                        $fila['id'],
                        $fila['modalidad'],
                        $fila['fecha'],
                        $fila['descripcion'],
                        $fila['puntuacion']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Verificar si ya existe una corrección para un alumno y una prueba
    function obtenerCorreccion($idAlumno, $idPrueba)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                'SELECT c.*, p.descripcion, p.puntuacion as max_puntos 
                 FROM correccion c 
                 INNER JOIN prueba p ON c.prueba = p.id 
                 WHERE c.alumno = ? AND c.prueba = ?'
            );
            $params = array($idAlumno, $idPrueba);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $prueba = new Prueba($fila['prueba'], null, null, $fila['descripcion'], $fila['max_puntos']);
                    $resultado = new Correccion($fila['alumno'], $prueba, $fila['puntos'], $fila['comentario']);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Guardar una corrección y actualizar la puntuación del alumno
    function guardarCorreccion($alumno, $prueba, $puntos, $comentario)
    {
        try {
            $this->conexion->beginTransaction();

            // Insertar la corrección
            $consulta = $this->conexion->prepare(
                'INSERT INTO correccion (alumno, prueba, puntos, comentario) VALUES (?, ?, ?, ?)'
            );
            $params = array($alumno, $prueba, $puntos, $comentario);
            $consulta->execute($params);

            // Actualizar la puntuación del alumno
            $consulta = $this->conexion->prepare(
                'UPDATE alumno SET puntuacion = puntuacion + ? WHERE id = ?'
            );
            $consulta->execute(array($puntos, $alumno));

            $this->conexion->commit();
        } catch (\Throwable $th) {
            $this->conexion->rollBack();
            echo $th->getMessage();
        }
    }

    // (Ejercicio 4) Obtener todas las correcciones de un alumno
    function obtenerCorreccionesAlumno($idAlumno)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare(
                'SELECT c.*, p.descripcion, p.puntuacion as max_puntos 
                 FROM correccion c 
                 INNER JOIN prueba p ON c.prueba = p.id 
                 WHERE c.alumno = ?'
            );
            $params = array($idAlumno);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $prueba = new Prueba($fila['prueba'], null, null, $fila['descripcion'], $fila['max_puntos']);
                    $resultado[] = new Correccion($fila['alumno'], $prueba, $fila['puntos'], $fila['comentario']);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 5) Finalizar un alumno marcándolo como finalizado
    function finalizarAlumno($idAlumno)
    {
        try {
            $consulta = $this->conexion->prepare(
                'UPDATE alumno SET finalizado = true WHERE id = ?'
            );
            $consulta->execute(array($idAlumno));
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    // (Ejercicio 6) Obtener los ganadores de cada modalidad
    function obtenerGanadores()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('CALL obtenerGandadores()');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = [
                        'modalidad' => $fila['modalidad'],
                        'nombre' => $fila['nombre'],
                        'puntuacion' => $fila['puntuacion']
                    ];
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    /**
     * (Ejercicio 1) Obtener conexión actual
     */
    public function getConexion()
    {
        return $this->conexion;
    }
}
?>
