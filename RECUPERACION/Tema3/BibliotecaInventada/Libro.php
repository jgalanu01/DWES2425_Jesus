<?php
class Libro {
    private $id;
    private $titulo;
    private $genero;
    private $anio;
    private $autor;

    public function __construct($id = null, $titulo = null, $genero = null, $anio = null, $autor = null) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->anio = $anio;
        $this->autor = $autor;
    }

    public function getId() { return $this->id; }
    public function getTitulo() { return $this->titulo; }
    public function getGenero() { return $this->genero; }
    public function getAnio() { return $this->anio; }
    public function getAutor() { return $this->autor; }

    public function setId($id) { $this->id = $id; }
    public function setTitulo($titulo) { $this->titulo = $titulo; }
    public function setGenero($genero) { $this->genero = $genero; }
    public function setAnio($anio) { $this->anio = $anio; }
    public function setAutor($autor) { $this->autor = $autor; }
}
?>
