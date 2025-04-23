<?php

require_once 'Usuarios.php';
require_once 'Recursos.php';
require_once 'Reservas.php';

$mensaje = '';

class Modelo
{

    private $conexion;

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


    function obtenerUsuario($usuario, $ps)
    {
        $respuesta = null;

        try {
            //Usamos prepare porque tenemos parametros, con el prepare hay que hacer el execute, con el query no
            $consulta = $this->conexion->prepare('SELECT * FROM usuarios WHERE idRayuela=? and ps=sha2(?,512)');
            $params = [$usuario, $ps]; //Los parametros, fijandonos en las interrogaciones,

            if ($consulta->execute($params)) {
                //Si la consulta se ejecuta hacemos el fetch para buscar el usuario a ver si existe
                if ($fila = $consulta->fetch()) { //Se hace if porque puede salir 0 o 1 al usaar idRayuela en el where
                    //Puedo poner los nombres de los campos o de las posiciones, lo que quiera
                    $respuesta = new Usuarios($fila['idRayuela'], $fila['nombre'], $fila['activo'], $fila['numReservas']); //ps no está en la clase Usuarios de php no hay que ponerla


                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }

        return $respuesta;
    }

    //Ejercicio 3

    function obtenerRecursos()
    {
        $respuesta = array();
        try {
            $consulta = $this->conexion->query('SELECT * FROM recursos'); //Con el query no hace falta hacer el execute
            while ($fila = $consulta->fetch()) //While porque puede ser 0 o muchos, no hay where en la consulta.
                $respuesta[] = new Recursos($fila['id'], $fila['nombre'], $fila['tipo'], $fila['descripcion']);
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
        }
        return $respuesta;
    }

    //Ejercicio 3, ver las reservas no anuladas de un recurso de forma descendente. Siempre que haya parametros es prepare

    function obtenerReservas($recurso)
    {
        $respuesta = array();

        try {

            //Hay que hacer join porque la consulta sin el join devolveria el id de rayuela y numero de recurso y en el exameen
            // la tabla tiene que devolver nombre de usuario y nombre de recurso,
            // hay que ir a la tabla recurso y no solo al campo recurso dentro de reserva
            //joins despues del on es la clave externa con la clave primaria de la tabla que la estamos relacionando

            $consulta = $this->conexion->prepare(' SELECT re.*,u.nombre as nombreU,r.nombre as nombreR FROM reservas as re join recursos as r on recurso=r.id join usuarios as u on usuario=idRayuela 
             where recurso = ? and anulada=false order by fecha desc;');
            $params = [$recurso];

            //El prepare siempre dentro de un if, con el execute
            if ($consulta->execute($params)) {

                //While porque puede haber 0 o muchas reservas
                while ($fila = $consulta->fetch()) {
                    $respuesta[] = new Reservas($fila['id'], new Usuarios($fila['usuario'],$fila['nombreU'],null,null), 
                    new Recursos(null,$fila['nombreR'],null,null), $fila['fecha'], $fila['hora'], $fila['anulada']);
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            global $mensaje;
            $mensaje = $th->getMessage();
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
