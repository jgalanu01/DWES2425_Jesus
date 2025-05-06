<?php


require_once 'Modelo.php';

session_start();

$bd=new Modelo();

if(isset($_POST['acceder'])){
    if(empty($_POST['idAutor'])||empty($_POST['ps'])){
        $mensaje="Autor o contraseña obligatorias";
    }else{
        $aut=$bd->obtenerAutor($_POST['idAutor'],$_POST['ps']);

        if($aut!=null and $aut->getActivo()){
            $_SESSION['autor']=$aut;
            header('location:index.php');

        }else{
            $mensaje='Usuario o contraseña incorrecto';
        }
    }
}elseif(isset($_POST['salir'])){
    session_destroy();
    header('location:index.php');
}elseif(isset($_SESSION['autor'])){
    $libros=$bd->obtenerLibrosAutor($_SESSION['autor']->getIdAutor());
}