<?php

require_once 'Modelo.php';
$bd=new Modelo();



$asignaturas=$bd->obtenerAsignaturas();


if(isset($_POST['Crear'])){

if(empty($_POST['fecha'])|| empty($_POST['asignatura']) || empty($_POST['descripcion']) || empty($_POST['nota'])){

    $mensaje='Los campos deben estar rellenos';

   
    } else{
        $notas=$bd->crearNota(new Notas(null,$_POST['asignatura'],$_POST['fecha'],$_POST['descripcion'],$_POST['nota']));

}

}






