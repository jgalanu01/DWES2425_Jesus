<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario</title>
</head>
<body>

<form action="" method="post">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="estatura">Estatura</label>
    <input type="number" name="estatura" id="estatura"><br>
    <label for="estado">Estado</label>
    <input type="checkbox" name="estado" id="estado"><br>
    <label for="edad">Edad</label>
    <input type="number" name="edad" id="edad"><br>
    <input type="submit" name="envio" value="Enviar">
</form>

<?php

if(isset($_POST['envio'])){
    if(!empty($_POST['nombre']) && !empty($_POST['estatura']) && !empty($_POST['edad'])){
        // Comprobamos si el checkbox 'estado' está marcado
        $estado = isset($_POST['estado']) ? 'Marcado' : 'No Marcado';

        $datos = array(
            'Nombre' => $_POST['nombre'],
            'Estatura' => $_POST['estatura'],
            'Estado' => $estado,
            'Edad' => $_POST['edad']
        );

        foreach($datos as $clave => $valor){
            echo "$clave: $valor<br>";
        }
        
    }else{
        echo "<h3 style='color:red;'>Todos los campos no han sido rellenados</h3>";
    }
}
?>

</body>
</html>
