<?php

class Trabajo
{
    private $fecha, $nombre, $tipoP, $servicios, $importe;




    function __construct($fecha, $nombre, $tipoP, $servicios, $importe)
    {
        $this->fecha = $fecha;
        $this->nombre = $nombre;
        $this->tipoP = $tipoP;
        $this->servicios = $servicios;
        $this->importe = $importe;
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

    /**
     * Get the value of tipoP
     */
    public function getTipoP()
    {
        return $this->tipoP;
    }

    /**
     * Set the value of tipoP
     *
     * @return  self
     */
    public function setTipoP($tipoP)
    {
        $this->tipoP = $tipoP;

        return $this;
    }

    /**
     * Get the value of servicios
     */
    public function getServicios()
    {
        return $this->servicios;
    }

    /**
     * Set the value of servicios
     *
     * @return  self
     */
    public function setServicios($servicios)
    {
        $this->servicios = $servicios;

        return $this;
    }

    /**
     * Get the value of importe
     */
    public function getImporte()
    {
        return $this->importe;
    }

    /**
     * Set the value of importe
     *
     * @return  self
     */
    public function setImporte($importe)
    {
        $this->importe = $importe;

        return $this;
    }
}
