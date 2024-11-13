<?php
require_once 'Entrada.php';
class Modelo
{
    private $nombre;

    function __construct($nom)
    {
        $this->nombre = $nom;
    }

    function guardarEntradas(Entrada $e)
    {
        try {
            //abrir el fichero
            $fichero = fopen($this->nombre, 'a+');
            //Insertar al final
            fwrite($fichero, $e->getNombre() . ';' . $e->getTipoEntrada() . ';' . $e->getFecha() . ';' . $e->getNEntradas() . ';' . $e->getDescuentos() . ',' . PHP_EOL);
            //Cerrar fichero
        } catch (Throwable $e) {
            echo $e->getMessage();
        } finally {
            if (isset($fichero))
                fclose($fichero);
        }
    }

    function obtenerEntradas()
    {
        $resultado = [];
        try {
            if (file_exists($this->nombre)) {
                //Cargar el fichero en un array
                $tmp = file($this->nombre, FILE_IGNORE_NEW_LINES);
                foreach ($tmp as $linea) {
                    $campos = explode(';', $linea);
                    //Crear objeto Entrada
                    $e = new Entrada($campos[0], $campos[1], $campos[2], $campos[3], $campos[4]);
                    //Añadimos $e a $resultado
                    $resultado[] = $e;
                }
            }
        } catch (Throwable $ex) {
            echo $ex->getMessage();
        }

        return $resultado;
    }


    public function getNombre()
    {
        return $this->nombre;
    }


    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
