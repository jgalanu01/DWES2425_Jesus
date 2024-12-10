<?php
require_once 'Modelo.php';
//Creamos una instancia de acceso a los datos
$modelo = new modelo('peliculas.txt');

function rellenarText($nombre)
{
    if (isset($_POST["guardar"]) and !empty($_POST[$nombre])) {
        echo "value='" . $_POST[$nombre] . "'";
    }
}
function rellenarFecha($fecha)
{
    if (isset($_POST["guardar"]) and isset($fecha)) {
        echo date("Y-m-d", strtotime($fecha));
    } else {
        echo date("Y-m-d");
    }
}
?>
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
            <input type="text" name="titulo" id="titulo" <?php rellenarText('titulo') ?>><br>
            <label for="fecha">Fecha de registro</label><br>
            <input type="date" name="fecha" id="fecha" value=<?php rellenarFecha($_POST['fecha']) ?>><br>
            <label for="genero">Género</label><br>
            <select name="genero[]" id="genero" multiple="multiple">
                <option>Comedia</option>
                <option>Terror</option>
                <option>Drama</option>
                <option>Aventura</option>
            </select><br>
            <label for="tipo">Tipo</label><br>
            <input type="radio" name="tipo" id="pelicula" value="pelicula" checked="checked">pelicula
            <input type="radio" name="tipo" id="serie" value="serie"
                <?php echo ((isset($_POST['tipo']) and $_POST['tipo'] == 'serie') ? 'checked="checked"' : '') ?>>serie <br>
            <label for="nCap">Nº Capitulos</label><br>
            <input type="number" name="nCap" id="nCap" <?php rellenarText('nCap') ?>><br>
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
        } elseif (!isset($_POST['genero'])) {
            echo "<h3 style='color:red;'>Es necesario marcar al menos un genero</h3>";
        } else {
            if ($_POST['tipo'] == 'pelicula') {
                $nCap = 0;
            } else {
                $nCap = $_POST['nCap'];
            }
            $fecha = date('d/m/Y', strtotime($_POST['fecha']));
            $genero = implode('/', $_POST['genero']);
            $p = new Pelicula($_POST['titulo'], $fecha, $genero, $_POST['tipo'], $nCap);

            $modelo->insertarPelicula($p);
        }
    }
    echo '<h3> Peliculas y Series </h3>';
    echo '<table border=2px>';
    echo '<tr><th>Titulo</th><th>Fecha</th><th>Genero</th><th>tipo</th><th>Nº Capitulos</th></tr>';
    $peliculas = $modelo->obtenerPelicula();
    foreach ($peliculas as $p) {
        echo '<tr>';
        echo '<td>' . $p->getTitulo() . '</td>';
        echo '<td>' . $p->getFecha() . '</td>';
        echo '<td>' . $p->getGenero() . '</td>';
        echo '<td>' . $p->getTipo() . '</td>';
        echo '<td>' . $p->getCapitulos() . '</td>';
        echo '</tr>';
    }
    echo '</table>';
    ?>
</body>

</html>