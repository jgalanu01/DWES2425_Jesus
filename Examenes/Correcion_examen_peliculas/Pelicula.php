<?php
class Pelicula
{

    private $titulo, $fecha, $genero, $tipo, $capitulos;

    function __construct($tit, $f, $g, $tip, $c)
    {
        $this->titulo = $tit;
        $this->fecha = $f;
        $this->genero = $g;
        $this->tipo = $tip;
        $this->capitulos = $c;
    }



    /**
     * Get the value of titulo
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set the value of titulo
     *
     * @return  self
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get the value of fecha
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     *
     * @return  self
     */
    public function setGenero($genero)
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of tipo
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of capitulos
     */
    public function getCapitulos()
    {
        return $this->capitulos;
    }

    /**
     * Set the value of capitulos
     *
     * @return  self
     */
    public function setCapitulos($capitulos)
    {
        $this->capitulos = $capitulos;

        return $this;
    }
}
