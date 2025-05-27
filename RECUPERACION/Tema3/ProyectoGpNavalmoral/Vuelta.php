<?php
class Vuelta
{
    private $id;
    private $piloto_id;
    private $tiempo;
    private $anulada;

    // Constructor
    public function __construct($id = null, $piloto_id=null, $tiempo=null, $anulada=null)
    {
        $this->id = $id;
        $this->piloto_id = $piloto_id;
        $this->tiempo = $tiempo;
        $this->anulada=$anulada;
    }

   

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of piloto_id
     */ 
    public function getPiloto_id()
    {
        return $this->piloto_id;
    }

    /**
     * Set the value of piloto_id
     *
     * @return  self
     */ 
    public function setPiloto_id($piloto_id)
    {
        $this->piloto_id = $piloto_id;

        return $this;
    }

    /**
     * Get the value of tiempo
     */ 
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set the value of tiempo
     *
     * @return  self
     */ 
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get the value of anulada
     */ 
    public function getAnulada()
    {
        return $this->anulada;
    }

    /**
     * Set the value of anulada
     *
     * @return  self
     */ 
    public function setAnulada($anulada)
    {
        $this->anulada = $anulada;

        return $this;
    }
}
