<?php

require_once 'Usuarios.php';
require_once 'Recursos.php';
require_once 'Reservas.php';

$mensaje='';

class Modelo{

    private $conexion;

    public function __construct() {

        try {

            $this->conexion=new PDO('mysql:host=localhost;port=3306;dbname=reservas' ,'root' ,'root');
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje=$th->getMessage();
            
           
        }
       
    }

    
    function obtenerUsuario($usuario,$ps){
        $respuesta=null;
        
        try {
            //Usamos prepare porque tenemos parametros, con el prepare hay que hacer el execute, con el query no
            $consulta=$this->conexion->prepare('SELECT * FROM usuarios WHERE idRayuela=? and ps=sha2(?,512)');
            $params=[$usuario,$ps]; //Los parametros, fijandonos en las interrogaciones,
        
            if($consulta->execute($params)){
                //Si la consulta se ejecuta hacemos el fetch para buscar el usuario a ver si existe
                if($fila=$consulta->fetch()){
                    //Puedo poner los nombres de los campos o de las posiciones, lo que quiera
                    $respuesta=new Usuarios($fila['idRayuela'],$fila['nombre'],$fila['activo'],$fila['numReservas']); //ps no está en la clase Usuarios de php no hay que ponerla


                }

            }
            
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje=$th->getMessage();
        }

        return $respuesta;

    }

    //Ejercicio 3

    function obtenerRecursos(){
        $respuesta=array();
        try {
            $consulta=$this->conexion->query('SELECT * FROM recursos'); //Con el query no hace falta hacer el execute

            
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