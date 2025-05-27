<?php
class Piloto
{
    private $id;
    private $nombre;
    private $escuderia;

    // Constructor
    public function __construct($id = null, $nombre = null,$escuderia=null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->escuderia = $escuderia;
    }

    // Getter y Setter para id
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter y Setter para nombre
    public function getNombre()
    {
        return $this->nombre;
    }
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

      // Getter y Setter para escuderia

    public function getEscuderia()
    {
        return $this->escuderia;
    }
    public function setEscuderia($escuderia)
    {
        $this->escuderia = $escuderia;
    }
}
