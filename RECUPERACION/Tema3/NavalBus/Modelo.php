<?php

require_once 'Billete.php';
require_once 'Linea.php';
require_once 'Conductor.php';
require_once 'Servicio.php';

$mensaje = '';

class Modelo
{

    private $conexion;

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



    public function __construct()
    {

        try {

            $this->conexion = new PDO('mysql:host=localhost;port=3306;dbname=reservas', 'root', 'root');
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }
    }


    public function obtenerLineas()
    {
        $respuesta = array();

        try {
            $consulta = $this->conexion->query('SELECT*from lineas');

            while ($fila = $consulta->fetch()) {


                $respuesta[] = new Linea($fila['id'], $fila['nombre'], $fila['origen'], $fila['destino']);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }

        return $respuesta;
    }
}
