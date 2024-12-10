<?php

require_once 'Nota.php';

class Modelo
{
    private $nombreFN = 'Notas.dat', $nombreFA = 'Asig.dat';

    function __construct() {}



    function crearNota(Nota $n)
    {

        try {

            $f= fopen($this->nombreFN,'a+');


            if ($f){//Si el fichero no existe en este momento se va a crear
            fwrite($f, $n->getAsi() . ';' . $n->getFecha() . ';' . $n->getTipo() . ';' . $n->getDesc() . ';' . $n->getNota() . PHP_EOL);
            fclose($f);
            }else{
                throw new exception("No se pudo abrir el archivo para escribir.");
            }
        } catch (Throwable $t){
            echo $t->getMessage();
        }
    }
        
    function obtenerNotas()
    {

        $resultado = array();

        try {
            if (file_exists($this->nombreFN)) {
                $registros = file($this->nombreFN);
                foreach ($registros as $linea) {
                    $campos = explode(';', $linea); //Explode para separar
                    if(count($campos)==5){
                    $resultado[] = new Nota($campos[0], $campos[1], $campos[2], $campos[3], $campos[4]);
                }
                }
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }



        return $resultado;
    }


    function obtenerAsignaturas() {
        $asignaturas=array();

        try{
            if(file_exists($this->nombreFA)){
                $asignaturas=file($this->nombreFA);

            }
        }catch (Throwable $th){
            echo $th->getMessage();
        }


        return $asignaturas;





    }
    }


