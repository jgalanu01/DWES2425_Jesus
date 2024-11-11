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
            <input type="date" name="fecha" value="<?php echo date('Y-m-d'); ?>" />
        </p>

        <p>
            <label>Cliente</label>
            <br>
            <input type="text" name="nombre" placeholder="Teclea nombre" />
        </p>

        <p>
            <label>Tipo de prenda</label>
            <br>
            <select name="tipoP">
                <option>Fiesta</option>
                <option>Cuero</option>
                <option>Hogar</option>
                <option selected="selected">Textil</option>
            </select>
        </p>

        <p>
            <label>Servicio</label>
            <br>
            <input type="checkbox" name="Limpieza" value="limp" />Limpieza
            <input type="checkbox" name="Planchado" value="planc" />Planchado
            <input type="checkbox" name="Desmanchado" value="desm" />Desmanchado
        </p>

        <p>
            <label>Importe</label>
            <br>
            <input type="number" name="importe" />
        </p>

        <p>
            <input type="submit" name="Guardar" value="Guardar">
        </p>
    </form>

    <?php
    if (isset($_POST["Guardar"])) {
        $mensaje = "";

        // Verificación de campos obligatorios
        if (empty($_POST["fecha"]) || empty($_POST["nombre"]) || empty($_POST["tipoP"]) || empty($_POST["importe"])) {
            $mensaje = "Error, la fecha, el cliente, el tipo de prenda y el importe no pueden estar vacíos.";
        }

        // Verificación de servicios
        if (empty($_POST["Limpieza"]) && empty($_POST["Planchado"]) && empty($_POST["Desmanchado"])) {
            $mensaje = "Error, debe haber al menos un servicio marcado.";
        }

        // Verificación de incompatibilidad entre prenda y servicio
        if ($_POST["tipoP"] == "Cuero" && !empty($_POST["Planchado"])) {
            $mensaje = "Error, el tipo de prenda 'Cuero' no es compatible con el servicio 'Planchado'.";
        }

        // Verificación de importe mínimo para prendas de fiesta
        if ($_POST["tipoP"] == "Fiesta" && $_POST["importe"] < 50) {
            $mensaje = "Error, las prendas de fiesta tienen un precio mínimo de 50 euros.";
        }

        // Mostrar mensaje de error o éxito
        if (!empty($mensaje)) {
            echo $mensaje;
        } else {

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

            // Mensaje de datos correctos
            echo "Datos correctos";
            echo "<p>Prenda: " . $_POST["tipoP"] . "</p>";
            echo "<p>Servicio: " . implode("/", $serviciosSeleccionados) . "</p>";
        }
    }
    ?>
</body>

</html>