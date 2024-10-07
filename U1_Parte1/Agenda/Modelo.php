<?php

require_once 'Contacto.php';

class Modelo{
    private $nombre;

    function __construct($nombreF)
    {
    $this->nombre=$nombreF;
    }

    function crearContacto(Contacto $c){
        try{

            $f=fopen($this->nombre,'a+'); //Si el fichero no existe en este momento se va a crear
            fwrite($f,$c->getId().';'.$c->getNombre().';'.$c->getTelefono().';'.$c->getTipo().';'.$c->getFoto().PHP_EOL);

        }
        catch(Throwable $t){
            echo $t->getMessage();

        }
        finally{
            fclose($f);

        }
    }

    function obtenerContactos(){
        $resultado=array();

        try {
            if(file_exists($this->nombre)){
            $registros=file($this->nombre);
            foreach($registros as $linea){
                $campos=explode(';',$linea); //Explode para separar
                $resultado=new Contacto($campos[0],$campos[1],$campos[2],$campos[3],$campos[4]);

            }

            }
           
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }



        return $resultado;
    }
    function obtenerID(){
        $resultado=1;
        try {
            if(file_exists($this->nombre)){
                $registros=file($this->nombre);
                //Obtengo la posición del array del último registro 
                $pos=sizeof($registros)-1;
                $campos=explode(';',$registros[$pos]);
                $resultado=$campos[0]+1;

            }
           
        } catch (\Throwable $th) {
           echo $th->getMessage();
        }
        
        return $resultado;
    }

    function obtenerContacto($telf){

        //Devuelve null si no hay un contacto para el teléfono buscado

        //Devuelve un objeto contacto si si hay un contacto para el teléfono buscado
        $resultado=null;

        try {
            if(file_exists($this->nombre)){
                $registros=file($this->nombre);
                foreach($registros as $linea){
                    $campos=explode(";",$linea);
                    if($campos[2]==$telf){ //el campo 3, 2 en la posicioón del array, es el del teléfono
                        //He encontrado un contacto para el teléfono buscado. Swi lo encuentra devuelve el contacto
                        $resultado=new Contacto($campos[0],$campos[1],$campos[2],$campos[3],$campos[4]);
                        return $resultado;
                    }
                }
            }

            
           
        } catch (\Throwable $th) {
            echo 'Error al obtener contacto:'.$th->getMessage();
        }

        return $resultado;
    }


    
}
?>