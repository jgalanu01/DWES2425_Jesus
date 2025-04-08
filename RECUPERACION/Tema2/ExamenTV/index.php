<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h3>Mis películas favoritas</h3>

<form action="" method="post">
    <fieldset>

    <legend>Crear Película</legend>
    <br/>
    <label for="titulo">Título de la película</label>
    <br/>
    <input type="text" name="titulo" id="titulo" value="<?php echo !empty($_POST['titulo'])  ? $_POST['titulo'] : ''  ?>">
    <br/>

    <label for="fecha">Fecha de registro</label>
    <br/>
    <input type="date" name="fecha" id="fecha" value="<?php echo isset($_POST['fecha'])?$_POST['fecha']: date('Y-m-d')?>">
    <br/>

    <label for="genero">Género</label>
    <br/>
    <select name="genero[]" id="genero" multiple>
        <option>Comedia</option>
        <option>Drama</option>
        <option>Terror</option>
        <option>Aventura</option>
    </select>
    <br/>

    <label>Tipo</label>
    <br/>
    <input type="radio" name="tipo" id="pelicula" value="pelicula" checked='checked'>
    <label for="pelicula">Pelicula</label>
    <input type="radio" name="tipo" id="serie" value="serie" <?php echo (isset($_POST['tipo']) && $_POST['tipo']=='serie')  ? "checked='checked'" :''?>>
    <label for="serie">Serie</label>
    <br/>

    <label for="capitulos">Nº de Capïtulos</label>
    <br/>
    <input type="number" name="capitulos" id="capitulos" value="<?php echo isset($_POST['capitulos']) ? $_POST['capitulos']: '1'?>">
    <br/>

    <button type="submit" name="guardar">Guardar</button>






    </fieldset>




</form>
 <?php

 if(isset($_POST['guardar'])){
    if(empty($_POST['titulo']) || !isset($_POST['fecha'])|| !isset($_POST['capitulos'])){
        echo 'Los campos no pueden estar vacios';
    }else{
        if(isset($_POST['tipo'])=='serie' && $_POST['capitulos']<=1){
            echo 'Error, tienes que marcar mas de un capítulo si seleccionas serie';
        }else{
            if(!isset($_POST['genero'])||empty($_POST['genero'])){
                echo 'Debes seleccionar al menos un género';
            }else{
                
            }
            
        }
    }
 }


?>


    
</body>
</html>