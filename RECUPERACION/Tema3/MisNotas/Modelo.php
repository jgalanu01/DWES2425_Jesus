<?php
require_once 'Notas.php';
require_once 'Asignaturas.php';

class Modelo
{
  private $conexion;

  public function __construct()
  {
    try {
      $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=misNotas', 'root', 'root');
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  // Obtener todas las asignaturas (solo para el select)
  function obtenerAsignaturas()
  {
    $respuesta = [];
    try {
      $consulta = $this->conexion->query('SELECT * FROM asignaturas');
      while ($fila = $consulta->fetch()) {
        $respuesta[] = new Asignaturas($fila['id'], $fila['nombre']);
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
    return $respuesta;
  }

  // Insertar nota
  function insertarNotas($asignatura, $fecha, $descripcion, $nota)
  {
    $respuesta = false;
    try {
      $consulta = $this->conexion->prepare('INSERT INTO notas VALUES (default, ?, ?, ?, ?, default)');
      $params = [$asignatura, $fecha, $descripcion, $nota];
      if ($consulta->execute($params) && $consulta->rowCount() == 1) {
        $respuesta = true;
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
    return $respuesta;
  }

  // Obtener notas con JOIN a asignaturas
  function obtenerNotas()
  {
    $respuesta = [];
    try {
      $consulta = $this->conexion->query('
        SELECT n.*, a.nombre AS nombreAsignatura 
        FROM notas n 
        JOIN asignaturas a ON n.asignatura = a.id 
        ORDER BY n.fecha DESC
      ');
      while ($fila = $consulta->fetch()) {
        $respuesta[] = new Notas(
          $fila['id'],
          new Asignaturas($fila['asignatura'], $fila['nombreAsignatura']),
          $fila['fecha'],
          $fila['descripcion'],
          $fila['nota'],
          $fila['anulada']
        );
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
    return $respuesta;
  }

  function anularNota($id)
  {
    $respuesta = false;
    try {
      $consulta = $this->conexion->prepare('UPDATE notas SET anulada = true WHERE id = ?');
      if ($consulta->execute([$id]) && $consulta->rowCount() == 1) {
        $respuesta = true;
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
    return $respuesta;
  }

  function borrarNota($id)
  {
    $respuesta = false;
    try {
      $consulta = $this->conexion->prepare('DELETE FROM notas WHERE id = ?');
      if ($consulta->execute([$id]) && $consulta->rowCount() == 1) {
        $respuesta = true;
      }
    } catch (\Throwable $th) {
      echo $th->getMessage();
    }
    return $respuesta;
  }

  public function getConexion()
  {
    return $this->conexion;
  }
}
