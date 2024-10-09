<?php

require_once 'Trabajo.php';

class Modelo{

    private $nombre;

    function __construct($nombreF)


     {
        $this->nombre=$nombreF;

     }

     function crearTrabajo(Trabajo $t){
        try{
            $f=fopen($this->nombre,'a+');
            fwrite($f,$t->getFecha().';'.$t->getNombre().';'.$t->getTipoP().';'.$t->getServicios().';'.$t->getImporte().PHP_EOL);

        }

        catch(Throwable $th){
            echo $th->getMessage();

        }
        finally{
            fclose($f);
        }
     }

     function obtenerTrabajo(){
        $resultado=array();
        try{
            if(file_exists($this->nombre)){
            $registros=file($this->nombre);
            foreach($registros as $linea){
                $campos=explode(';', $linea);
                $resultado= new Trabajo($campos[0],$campos[1],$campos[2],$campos[3],$campos[4]);
            }
            }
        } catch (\Throwable $th2){
            echo $th2->getMessage();
        }

        return $resultado;
     }

     
}

?>