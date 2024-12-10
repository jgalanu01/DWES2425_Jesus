<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peliculas</title>
</head>

<body>
    <fieldset>
        <legend>Crear Pelicula</legend>
        <form action="#" method="post">

            <label for="titulo">Titulo de la pelicula</label><br>
            <input type="text" name="titulo" id="titulo"><br>

            <label for="fecha">Fecha de registro</label><br>
            <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>"><br>
            <label for="genero">Género</label><br>
            <select name="genero[]" id="genero" multiple="multiple">
                <option>Comedia</option>
                <option>Terror</option>
                <option>Drama</option>
                <option>Aventura</option>
            </select><br>
            <label>Tipo</label><br>
            <input type="radio" name="tipo" id="pelicula" value="pelicula" checked>
            <label for="pelicula">Película</label>

            <input type="radio" name="tipo" id="serie" value="serie">
            <label for="serie">Serie</label><br>

            <label for="nCap">Nº Capitulos</label><br>
            <input type="number" name="nCap" id="nCap"><br>
            <br>
            <input type="submit" value="Guardar" name="guardar">
        </form>
    </fieldset>
    <?php
    if (isset($_POST['guardar'])) {
        if (empty($_POST['titulo']) or empty($_POST['fecha']) or empty($_POST['nCap'])) {
            echo "<h3 style='color:red;'>El titulo, fecha  y Nº Capitulos son obligatorios</h3>";
        } elseif ($_POST['tipo'] == 'serie' and $_POST['nCap'] <= 1) {
            echo "<h3 style='color:red;'>Si es una serie necesita mas de un capítulo</h3>";
        } elseif (!isset($_POST['genero']) or sizeof($_POST['genero']) < 1) {
            echo "<h3 style='color:red;'>Es necesario marcar al menos un genero</h3>";
        } else {
            echo "<h2>Datos Corectos</h2>";
            echo "<h3>Pelicula: " . $_POST['titulo'] . "</h3>";
            echo "<h3>Generos: " . implode('/', $_POST['genero']) . "</h3>";
        }
    }
    ?>
</body>

</html>