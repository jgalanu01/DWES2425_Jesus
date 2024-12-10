<?php

require_once 'Trabajo.php';

class Modelo
{

    private $nombre;


    function __construct($nombreF)
    {
        $this->nombre = $nombreF;
    }

    // Método para crear un trabajo y guardarlo en el archivo
    function crearTrabajo(Trabajo $t)
    {
        try {

            $f = fopen($this->nombre, 'a+');
            if (!$f) {
                throw new Exception("No se pudo abrir el archivo para escribir");
            }
            fwrite($f, $t->getFecha() . ';' . $t->getNombre() . ';' . $t->getTipoP() . ';' . $t->getServicios() . ';' . $t->getImporte() . PHP_EOL);
        } catch (Throwable $th) {
            echo "Error al guardar el trabajo: " . $th->getMessage();
        } finally {
            if ($f) {
                fclose($f);
            }
        }
    }

    // Método para obtener todos los trabajos del archivo

    function obtenerTrabajos()
    {
        $resultado = [];
        try {
            if (file_exists($this->nombre)) {
                $registros = file($this->nombre, FILE_IGNORE_NEW_LINES);
                foreach ($registros as $linea) {
                    $campos = array_map('trim', explode(';', $linea));
                    if (count($campos) === 5) { // Asegura que todos los campos estén presentes
                        $resultado[] = new Trabajo($campos[0], $campos[1], $campos[2], $campos[3], $campos[4]);
                    }
                }
            } else {
                echo "Archivo no encontrado: " . $this->nombre;
            }
        } catch (Throwable $th2) {
            echo "Error al leer el archivo: " . $th2->getMessage();
        }

        return $resultado;
    }

    /**
     * Get the value of nombre
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }
}
