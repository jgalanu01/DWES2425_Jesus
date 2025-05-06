<?php
class Autor {
    private $idAutor;
    private $nombre;
    private $activo;

    public function __construct($id = null, $nombre = null, $activo = true) {
        $this->idAutor = $id;
        $this->nombre = $nombre;
        $this->activo = $activo;
    }

    public function getIdAutor() { return $this->idAutor; }
    public function getNombre() { return $this->nombre; }
    public function getActivo() { 
        return $this->activo;
     }

    public function setIdAutor($id) { $this->idAutor = $id; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setActivo($activo) { $this->activo = $activo; }
}
?>
