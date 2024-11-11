<?php

require_once 'Modelo.php';

function recordarPrenda($nombre, $valor)
{
    if (isset($_POST["Guardar"]) && $_POST[$nombre] == $valor) {
        echo "selected='selected'";
    }
}

function recordarValor($nombre)
{
    if (isset($_POST["Guardar"]) && !empty($_POST[$nombre])) {
        echo "value='" . $_POST[$nombre] . "'";
    }
}

function recordarServicio($nombre, $valor)
{
    if (isset($_POST["Guardar"]) && isset($_POST[$nombre]) && $_POST[$nombre] == $valor) {
        echo "checked='checked'";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h3>Tintorería La Morada</h3>
    <form action="" method="post">
        <p>
            <label>Fecha de entrada</label>
            <br>
            <input type="date" name="fecha" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'); ?>" />
        </p>

        <p>
            <label>Cliente</label>
            <br>
            <input type="text" name="nombre" placeholder="Teclea nombre" <?php recordarValor("nombre"); ?> />
        </p>

        <p>
            <label>Tipo de prenda</label>
            <br>
            <select name="tipoP">
                <option <?php recordarPrenda("tipoP", "Fiesta"); ?>>Fiesta</option>
                <option <?php recordarPrenda("tipoP", "Cuero"); ?>>Cuero</option>
                <option <?php recordarPrenda("tipoP", "Hogar"); ?>>Hogar</option>
                <option <?php recordarPrenda("tipoP", "Textil"); ?> selected="selected">Textil</option>
            </select>
        </p>

        <p>
            <label>Servicio</label>
            <br>
            <input type="checkbox" name="Limpieza" value="limp" <?php recordarServicio("Limpieza", "limp"); ?> />Limpieza
            <input type="checkbox" name="Planchado" value="planc" <?php recordarServicio("Planchado", "planc"); ?> />Planchado
            <input type="checkbox" name="Desmanchado" value="desm" <?php recordarServicio("Desmanchado", "desm"); ?> />Desmanchado
        </p>

        <p>
            <label>Importe</label>
            <br>
            <input type="number" name="importe" <?php recordarValor("importe"); ?> />
        </p>

        <p>
            <input type="submit" name="Guardar" value="Guardar">
        </p>
    </form>

    <?php
    if (isset($_POST["Guardar"])) {
        $mensaje = "";

        // Validación de campos obligatorios
        if (empty($_POST["fecha"]) || empty($_POST["nombre"]) || empty($_POST["tipoP"]) || empty($_POST["importe"])) {
            $mensaje = "Error, la fecha, el cliente, el tipo de prenda y el importe no pueden estar vacíos.";
        }

        // Validación de selección de al menos un servicio
        if (empty($_POST["Limpieza"]) && empty($_POST["Planchado"]) && empty($_POST["Desmanchado"])) {
            $mensaje .= "<br>Error, debe haber al menos un servicio marcado.";
        }

        // Validación de incompatibilidad entre prenda y servicio
        if ($_POST["tipoP"] == "Cuero" && !empty($_POST["Planchado"])) {
            $mensaje .= "<br>Error, el tipo de prenda 'Cuero' no es compatible con el servicio 'Planchado'.";
        }

        // Validación de importe mínimo para prendas de fiesta
        if ($_POST["tipoP"] == "Fiesta" && $_POST["importe"] < 50) {
            $mensaje .= "<br>Error, las prendas de fiesta tienen un precio mínimo de 50 euros.";
        }

        // Mostrar mensajes de error o proceder a guardar el trabajo
        if (!empty($mensaje)) {
            echo $mensaje;
        } else {
            // Concatenación de servicios seleccionados
            $serviciosSeleccionados = [];
            if (!empty($_POST["Limpieza"])) {
                $serviciosSeleccionados[] = "Limpieza";
            }
            if (!empty($_POST["Planchado"])) {
                $serviciosSeleccionados[] = "Planchado";
            }
            if (!empty($_POST["Desmanchado"])) {
                $serviciosSeleccionados[] = "Desmanchado";
            }
            $serviciosConcatenados = implode("/", $serviciosSeleccionados);

            // Crear una instancia de Trabajo con los datos del formulario
            $trabajo = new Trabajo($_POST["fecha"], $_POST["nombre"], $_POST["tipoP"], $serviciosConcatenados, $_POST["importe"]);

            // Guardar el trabajo en el archivo usando Modelo
            $modelo = new Modelo("trabajos.txt");
            $modelo->crearTrabajo($trabajo);

            // Mensaje de datos guardados correctamente
            echo "<p>Datos guardados correctamente:</p>";
            echo "<p>Prenda: " . $_POST["tipoP"] . "</p>";
            echo "<p>Servicio: " . $serviciosConcatenados . "</p>";
            echo "<p>Importe: " . $_POST["importe"] . " euros</p>";
        }
    }
    ?>
</body>

</html>