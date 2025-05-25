<?php
class Notas
{
    private $id;
    private $asignatura;
    private $fecha;
    private $descripcion;
    private $nota;
    private $anulada;

    // Constructor
    public function __construct($id = null, $asignatura = null, $fecha = null, $descripcion = null, $nota = null, $anulada = null)
    {
        $this->id = $id;
        $this->asignatura = $asignatura;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->nota = $nota;
        $this->anulada = $anulada;
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

    // Getter y Setter para asignatura
    public function getAsignatura()
    {
        return $this->asignatura;
    }
    public function setAsignatura($asignatura)
    {
        $this->asignatura = $asignatura;
    }

    // Getter y Setter para nota
    public function getNota()
    {
        return $this->nota;
    }
    public function setNota($nota)
    {
        $this->nota = $nota;
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
     * Get the value of descripcion
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set the value of descripcion
     *
     * @return  self
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

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
