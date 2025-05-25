<?php
require_once 'Modelo.php';
session_start();

$bd = new Modelo();

if ($bd->getConexion() == null) {
  $mensaje = 'Error en la conexión con la base de datos';
}

// Crear nota
if (isset($_POST['crear'])) {
  if (empty($_POST['fecha']) || empty($_POST['descripcion']) || empty($_POST['notas'])) {
    $mensaje = 'Todos los campos son obligatorios';
  } else {
    $resultado = $bd->insertarNotas(
      $_POST['asignatura'],
      $_POST['fecha'],
      $_POST['descripcion'],
      $_POST['notas']
    );

    if ($resultado) {
      $_SESSION['ultimaNota'] = new Notas(
        null,
        $_POST['asignatura'],
        $_POST['fecha'],
        $_POST['descripcion'],
        $_POST['notas'],
        false
      );
      $mensaje = 'Nota creada correctamente';
    } else {
      $mensaje = 'Error al insertar la nota';
    }
  }
}

// Anular nota
if (isset($_POST['anular'])) {
  if ($bd->anularNota($_POST['anular'])) {
    $mensaje = 'Nota anulada correctamente';
  } else {
    $mensaje = 'Error al anular la nota';
  }
}

// Borrar nota
if (isset($_POST['borrar'])) {
  if ($bd->borrarNota($_POST['borrar'])) {
    $mensaje = 'Nota borrada correctamente';
  } else {
    $mensaje = 'Error al borrar la nota';
  }
}
