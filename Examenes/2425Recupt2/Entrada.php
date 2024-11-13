<?php

class Entrada{

    private $nombre, $tipoEntrada, $fecha, $nEntradas, $descuentos;

    function __construct($nombre, $tipoEntrada, $fecha, $nEntradas, $descuentos)
    {
        $this->nombre = $nombre;
        $this->tipoEntrada = $tipoEntrada;
        $this->fecha = $fecha;
        $this->nEntradas = $nEntradas;
        $this->descuentos = $descuentos;
       
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
     * Get the value of tipoEntrada
     */ 
    public function getTipoEntrada()
    {
        return $this->tipoEntrada;
    }

    /**
     * Set the value of tipoEntrada
     *
     * @return  self
     */ 
    public function setTipoEntrada($tipoEntrada)
    {
        $this->tipoEntrada = $tipoEntrada;

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
     * Get the value of nEntradas
     */ 
    public function getNEntradas()
    {
        return $this->nEntradas;
    }

    /**
     * Set the value of nEntradas
     *
     * @return  self
     */ 
    public function setNEntradas($nEntradas)
    {
        $this->nEntradas = $nEntradas;

        return $this;
    }

    /**
     * Get the value of descuentos
     */ 
    public function getDescuentos()
    {
        return $this->descuentos;
    }

    /**
     * Set the value of descuentos
     *
     * @return  self
     */ 
    public function setDescuentos($descuentos)
    {
        $this->descuentos = $descuentos;

        return $this;
    }
}