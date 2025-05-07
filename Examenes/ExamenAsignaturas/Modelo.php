<?php

require_once 'Asignaturas.php';
require_once 'Notas.php';

$mensaje='';


class Modelo{

    private $conexion;

    function __construct(){
        try {
            $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=misNotas', 'root', 'root');
        } catch (\Throwable $th) {
            $th->getMessage();
           global $mensaje;
           $mensaje=$th->getMessage();
        }
    }




    function obtenerAsignaturas(){
        $resultado=array();


        try {
            $consulta=$this->conexion->query('SELECT * from asignaturas ');

            while($fila=$consulta->fetch()){
                $resultado[]=new Asignaturas($fila['id'],$fila['nombre']);

            }

       
        } catch (\Throwable $th) {
            $th->getMessage();
           global $mensaje;
           $mensaje=$th->getMessage();
        }


        return $resultado;

       

        
    }


    function crearNota($asignatura){

        $resultado=null;

        try {
            $consulta=$this->conexion->prepare('INSERT into notas values (default,?,?,?,?,false)');
            $params=[$asignatura->getAsignatura(),$asignatura->getFecha(),$asignatura->getDescripcion(),$asignatura->getNota()];

            if($consulta->execute($params)){
                if($fila=$consulta->fetch()){
                    if($consulta->rowCount()==1){

                    $resultado=new Notas($fila['asignatura'],$fila['fecha'],$fila['descripcion'],$fila['nota'],$fila['anulada']);
                    }

                }
            }
            
        } catch (\Throwable $th) {
            $th->getMessage();
            global $mensaje;
            $mensaje=$th->getMessage();
        }

        return $resultado;

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