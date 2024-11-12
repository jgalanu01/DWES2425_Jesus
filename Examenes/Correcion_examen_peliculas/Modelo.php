<?php
require_once 'Pelicula.php';
class Modelo
{
    private $nombre;

    function __construct($nom)
    {
        $this->nombre = $nom;
    }

    function insertarPelicula(Pelicula $p)
    {
        try {
            //abrir el fichero
            $fichero = fopen($this->nombre, 'a+');
            //Insertar al final
            fwrite($fichero, $p->getTitulo() . ';' . $p->getFecha() . ';' . $p->getGenero() . ';' . $p->getTipo() . ';' . $p->getCapitulos() . PHP_EOL);
            //Cerrar fichero
        } catch (Throwable $e) {
            echo $e->getMessage();
        } finally {
            if (isset($fichero))
                fclose($fichero);
        }
    }

    function obtenerPelicula()
    {
        $resultado = [];
        try {
            if (file_exists($this->nombre)) {
                //Cargamos el fichero en un array
                $tmp = file($this->nombre);
                foreach ($tmp as $linea) {
                    $campos = explode(';', $linea);
                    //Crear objeto pelicula
                    $p = new Pelicula($campos[0], $campos[1], $campos[2], $campos[3], $campos[4]);
                    //Añadimos $p a $resultado
                    $resultado[] = $p;
                }
            }
        } catch (Throwable $e) {
            echo $e->getMessage();
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
