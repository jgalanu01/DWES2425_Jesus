<?php
require_once 'Modalidad.php'; // (Ejercicio 1) Clase para manejar datos de modalidad
require_once 'Alumno.php'; // (Ejercicio 2) Clase para manejar datos de alumnos
require_once 'Correccion.php'; // (Ejercicios 4 y 5) Clase para manejar datos de correcciones
require_once 'Prueba.php'; // (Ejercicio 4) Clase para manejar datos de pruebas

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
            // Manejar error de conexión
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

    // (Ejercicio 1) Obtener una modalidad específica por ID
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

    // (Ejercicio 2) Obtener todos los alumnos de una modalidad específica
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

    // (Ejercicio 2) Obtener un alumno específico por ID
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

    // (Ejercicio 4) Obtener una prueba específica por ID
    function obtenerPrueba($idP)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from prueba where id = ?');
            $params = array($idP);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
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

    // (Ejercicio 4) Obtener corrección de un alumno para una prueba específica
    function obtenerCorrecion($idP, $idA)
    {
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from correccion where alumno = ? and prueba = ?');
            $params = array($idA, $idP);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Correccion(
                        $fila['alumno'],
                        $fila['prueba'],
                        $fila['puntos'],
                        $fila['comentario']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Crear una corrección y actualizar la puntuación del alumno
    function crearCorreccion($idP, $idA, $puntos, $desc)
    {
        $resultado = false;
        try {
            $this->conexion->beginTransaction();

            // Insertar la corrección
            $consulta = $this->conexion->prepare('INSERT INTO correccion VALUES (?, ?, ?, ?)');
            $params = array($idA, $idP, $puntos, $desc);
            if ($consulta->execute($params)) {
                if ($consulta->rowCount() == 1) {
                    // Actualizar la puntuación del alumno
                    $consulta = $this->conexion->prepare(
                        'UPDATE alumno SET puntuacion = puntuacion + ? WHERE id = ?'
                    );
                    $params = array($puntos, $idA);
                    if ($consulta->execute($params) && $consulta->rowCount() == 1) {
                        $this->conexion->commit();
                        $resultado = true;
                    } else {
                        $this->conexion->rollBack(); // Deshacer si algo falla
                    }
                }
            }
        } catch (\Throwable $th) {
            $this->conexion->rollBack();
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 4) Obtener todas las calificaciones de un alumno
    function obtenerCalificaciones($idA)
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare(
                'SELECT * FROM correccion AS c
                 INNER JOIN prueba AS p ON c.prueba = p.id
                 WHERE alumno = ?'
            );
            $params = array($idA);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Correccion(
                        $fila['alumno'],
                        new Prueba($fila['prueba'], $fila['modalidad'], $fila['fecha'], $fila['descripcion'], $fila['puntuacion']),
                        $fila['puntos'],
                        $fila['comentario']
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 5) Finalizar corrección del alumno
    function finalizarCorreccion($idA)
    {
        $resultado = false;
        try {
            $consulta = $this->conexion->prepare('UPDATE alumno SET finalizado = true WHERE id = ?');
            $params = array($idA);
            if ($consulta->execute($params) && $consulta->rowCount() == 1) {
                $resultado = true;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // (Ejercicio 6) Obtener los ganadores de cada modalidad
    function obtenerGanadores()
    {
        $resultado = array();
        try {
            $consulta = $this->conexion->prepare('CALL obtenerGanadores()');
            if ($consulta->execute()) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = array($fila[0], $fila[1], $fila[2]);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
        return $resultado;
    }

    // Métodos getter y setter para conexión
    public function getConexion()
    {
        return $this->conexion;
    }

    public function setConexion($conexion)
    {
        $this->conexion = $conexion;
        return $this;
    }
}
