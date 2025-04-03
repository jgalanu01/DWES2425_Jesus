<?php
require_once 'Entrada.php';



class Modelo{
    private $fichero='entradas.txt';



    function insertar(Entrada $e){

        try{

       

        $f=fopen($this->fichero,'a');
        //insertar
        fwrite($f, $e->getNombreCliente().';'.$e->getTipoEntrada().';'.$e->getFechaEvento().';'.$e->getNEntradas().';'.$e->getDescuentos().';'.$e->getImporte().';'.$e->getTipoEntrada().PHP_EOL);
        fclose($f);

        return true;

    }catch(\Throwable $th){
        echo 'Error al guardar la entrada:'.$th->getMessage();

    }

    return false;
}

    function cargar(){

    }

}