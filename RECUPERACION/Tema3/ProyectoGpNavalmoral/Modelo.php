<?php 

require_once 'Piloto.php';
require_once 'Vuelta.php';



$mensaje='';

class Modelo{

    private $conexion;
    public function __construct(){
        try {
            $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=F1', 'root', 'root');
          } catch (PDOException $e) {
            echo $e->getMessage();
            global $mensaje;
            $mensaje = $e->getMessage();
          }
        
    }


    function obtenerPilotos(){
        $respuesta=[];
       

        try {

            $consulta=$this->conexion->query('SELECT * FROM pilotos');

            while($fila=$consulta->fetch()){
                $respuesta[]= new Piloto($fila['id'],$fila['nombre'],$fila['escuderia']);
            }

          
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }

        return $respuesta;

    }

    function obtenerPiloto($id){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare(
                'select * from pilotos where id = ?'
            );
            $params = array($id);
            if ($consulta->execute($params)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Piloto(
                        $fila['id'],
                        $fila['nombre'],
                        $fila['escuderia'],
                        
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }
        return $resultado;
    }

    function insertarVuelta($piloto,$vuelta){
        $respuesta=false;
        try {
            $consulta=$this->conexion->prepare('INSERT INTO vueltas VALUES(default,now(),now(),?,?,false)');
            $params=[$piloto->getId(),$vuelta];

            if($consulta->execute($params) && $consulta->rowCount()==1){
                $respuesta=true;

            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }

        return $respuesta;

    }

    function obtenerVueltas($id){
        $resultado=[];
        try {
            $consulta = $this->conexion->prepare(
                'SELECT v.*, p.nombre as nombrePiloto
                FROM vueltas v 
                JOIN pilotos p ON v.piloto_id=p.id
                where piloto_id=?'
            );
            $params = array($id);
            if ($consulta->execute($params)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Vuelta(
                        $fila['id'],
                        new Piloto($fila['piloto_id'],$fila['nombrePiloto']),
                        $fila['tiempo'],
                        $fila['anulada']
                       
                    );
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }
        return $resultado;
    }



    function anularVuelta($id){
        $respuesta = false;
        try {
          $consulta = $this->conexion->prepare('UPDATE vueltas SET anulada = true WHERE id = ?');
          if ($consulta->execute([$id]) && $consulta->rowCount() == 1) {
            $respuesta = true;
          }
        } catch (\Throwable $th) {
          echo $th->getMessage();
        }
        return $respuesta;
    }

    function borrarVuelta($id){
        $respuesta = false;
        try {
          $consulta = $this->conexion->prepare('DELETE from vueltas where id=?');
          if ($consulta->execute([$id]) && $consulta->rowCount() == 1) {
            $respuesta = true;
          }
        } catch (\Throwable $th) {
          echo $th->getMessage();
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