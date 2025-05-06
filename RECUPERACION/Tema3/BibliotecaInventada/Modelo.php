<?php

require_once 'Autor.php';
require_once 'Libro.php';

$mensaje='';


class Modelo{

    private $conexion;

    public function __construct(){

    try {
        $this->conexion=new PDO('mysql:host=localhost;port=3306;dbname=biblioteca2','root','root');
    } catch (\Throwable $th) {
        echo $th->getMessage();
        global $mensaje;
        $mensaje=$th->getMessage();
    }
}

public function obtenerAutor($autor,$ps){

    $respuesta=null;

    try {
        $consulta=$this->conexion->prepare('SELECT * FROM autores WHERE idAutor=? and pass=sha2(?,512)');
        $params=[$autor,$ps];


        if($consulta->execute($params)){
            if($fila=$consulta->fetch()){
                $respuesta=new Autor($fila['idAutor'],$fila['nombre'],$fila['activo']);
            }
        }
        
    } catch (\Throwable $th) {
        echo $th->getMessage();
        global $mensaje;
        $mensaje=$th->getMessage();
    }

    return $respuesta;


}

public function obtenerLibrosAutor($idAutor){
    $respuesta=array();

    try {
        $consulta=$this->conexion->prepare('SELECT * FROM libros where autor=?');
        $params=[$idAutor];

        if($consulta->execute($params)){
            while($fila=$consulta->fetch()){
                $respuesta[]=new Libro($fila['id'],$fila['titulo'],$fila['genero'],$fila['anio'],$fila['autor']);
            }
        }

    } catch (\Throwable $th) {
       echo $th->getMessage();
       global $mensaje;
       $mensaje=$th->getMessage();
    }

    return $respuesta;
}


    /**
     * Get the value of conexion
     */ 
    public function getConexion()
    {
        return $this->conexion;
    }

    /**
     * Set the value of conexion
     *
     * @return  self
     */ 
    public function setConexion($conexion)
    {
        $this->conexion = $conexion;

        return $this;
    }
}



?>