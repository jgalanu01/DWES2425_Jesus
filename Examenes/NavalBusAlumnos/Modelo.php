<?php
require_once 'Billete.php';
require_once 'Conductor.php';
require_once 'Linea.php';
require_once 'Servicio.php';

class Modelo{

    private $conexion=null;

    function __construct(){
        try {
            $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=navalBus', 'root', 'root');
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
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

    function obtenerLineas(){
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from lineas');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Linea($fila['id'],$fila['nombre'],$fila['origen'],$fila['destino']);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;

    }

    function obtenerConductores(){
        $resultado = array();
        try {
            $consulta = $this->conexion->query('SELECT * from conductores');
            while ($fila = $consulta->fetch()) {
                $resultado[] = new Conductor ($fila['id'],$fila['nombreApe'],$fila['telefono'],$fila['fechaContrato']);
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;

    }

    function obtenerLinea($id){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from lineas where id=?');
            $param = array($id);
            if ($consulta->execute($param)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Linea ($fila['id'], $fila['nombre'], $fila['origen'], $fila['destino']);
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;

    }

    function obtenerConductor($id){
        $resultado = null;
        try {
            $consulta = $this->conexion->prepare('SELECT * from conductores where id=?');
            $param = array($id);
            if ($consulta->execute($param)) {
                if ($fila = $consulta->fetch()) {
                    $resultado = new Conductor ($fila['id'], $fila['nombreApe'], $fila['telefono'], $fila['fechaContrato']);
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;

    }

    function ObtenerPrecioActual($tipo){

        $resultado = [];
        try {
            $consulta = $this->conexion->prepare('SELECT * from billetes as b join lineas as l
            on b.linea=l.id join conductores as c on b.conductor=c.id where billete.tipo=? ');
            $param = array($tipo);
            if ($consulta->execute($param)) {
                while ($fila = $consulta->fetch()) {
                    $resultado[] = new Billete ($fila[0], 
                    new Linea($fila['nombre'],$fila['origen'],$fila['destino']),
                    new Conductor ($fila['nombreApe'],$fila['telefono'],$fila['fechaContrato']);
                    );
                }
            }
        } catch (PDOException $th) {
            echo $th->getMessage();
        }
        return $resultado;

    }

    function finalizarServicio($id){
        $resultado = false;
        try {
            $this->conexion->beginTransaction();
            $consulta = $this->conexion->prepare('delete from lineas where id = ?');
            $param = array($id);
            if($consulta->execute($param)){
                $consulta = $this->conexion->prepare('delete from conductores where id = ?');
                $param = array($id);
                if($consulta->execute($param)){
                    $this->conexion->commit();
                    $resultado = true;
                }
            }
            
        } catch (PDOException $th) {
            $this->conexion->rollback();
            echo $th->getMessage();
        }
        return $resultado;
    }

    }


