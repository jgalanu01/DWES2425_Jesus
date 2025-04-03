<?php

class Entrada{
    private $nombreCliente;
    private $fechaEvento;
    private $nEntradas;
    private $descuentos;
    private $importe;
    private $tipoEntrada;

    function __construct($n,$fe,$ne,$d,$i,$te){
        $this->nombreCliente = $n;
        $this->fechaEvento = $fe;
        $this->nEntradas = $ne;
        $this->descuentos = $d;
        $this->importe = $i;
        $this->tipoEntrada = $te;

    }

    /**
     * Get the value of nombreCliente
     */ 
    public function getNombreCliente()
    {
        return $this->nombreCliente;
    }

    /**
     * Set the value of nombreCliente
     *
     * @return  self
     */ 
    public function setNombreCliente($nombreCliente)
    {
        $this->nombreCliente = $nombreCliente;

        return $this;
    }

    /**
     * Get the value of fechaEvento
     */ 
    public function getFechaEvento()
    {
        return $this->fechaEvento;
    }

    /**
     * Set the value of fechaEvento
     *
     * @return  self
     */ 
    public function setFechaEvento($fechaEvento)
    {
        $this->fechaEvento = $fechaEvento;

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
}




?>