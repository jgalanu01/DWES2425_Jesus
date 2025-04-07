<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <fieldset>
        <legend>Ejercicio Camping</legend>
        <br/>
        <label for="nombre">Nombre completo:</label>
        <br/>
        <input type="text" name="nombre" id="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre']: ''?>">
        <br/>

        <label for="fecha">Fecha de la Reserva</label>
        <br/>
        <input type="date" name="fecha" id="fecha" value="<?php echo !empty($_POST['fecha']) ? $_POST['fecha'] :date('Y-m-d')?>">
        <br/>

        <label for="tipoA">Tipo de alojamiento</label>
        <br/>
        <select name="tipoA" id="tipoA">
            <option value="Tienda" <?php echo (isset ($_POST['tipoA']) &&  $_POST['tipoA']=='Tienda') ? 'selected="selected"' : ''?>>Tienda</option>
            <option value="Bungalow" <?php echo (isset ($_POST['tipoA']) &&  $_POST['tipoA']=='Bungalow') ? 'selected="selected"' : ''?>>Bungalow</option>
            <option value="Autocaravana" <?php echo (isset ($_POST['tipoA']) &&  $_POST['tipoA']=='Autocaravana') ? 'selected="selected"' : ''?>>Autocaravana</option>
        </select>
    <br/>
    <br/>

        <label>Actividad elegida:</label>
        <br/>
        <input type="radio" name="actividad" id="senderismo" value="senderismo" <?php echo (isset ($_POST['actividad']) &&  $_POST['actividad']=='senderismo') ? 'checked="checked"' : ''?>>
        <label for="senderismo">Senderismo</label>
        
        <input type="radio" name="actividad" id="kayak" value="kayak"  <?php echo (isset ($_POST['actividad']) &&  $_POST['actividad']=='kayak') ? 'checked="checked"' : ''?>>
        <label for="kayak">Kayak</label>

        <input type="radio" name="actividad" id="tirolina" value="tirolina"  <?php echo (isset ($_POST['actividad']) &&  $_POST['actividad']=='tirolina') ? 'checked="checked"' : ''?>>
        <label for="tirolina">Tirolina</label>
        <br/>

        <button type="submit" name="reservar">Reservar</button>








    </fieldset>
</form>


<?php


if(isset($_POST['reservar'])){
    if(empty($_POST['nombre']) || !isset($_POST['fecha'])|| !isset($_POST['tipoA']) || !isset($_POST['actividad'])){
        echo 'Error, campos vacíos';
    }else{
        if($_POST['tipoA']=='Autocaravana'&& $_POST['actividad']=='tirolina'){
            echo 'No se puede escoger autocaravana con la actividad de tirolina';
        }else{
            
        }
    }
}




?>
    
</body>
</html>