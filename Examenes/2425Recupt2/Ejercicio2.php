<?php

function recordarEntrada($nombre, $valor)
{
    if (isset($_POST["comprar"]) && isset($_POST[$nombre]) && $_POST[$nombre] == $valor) {
        echo "checked='checked'";
    }
}


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultura de Navalmoral</title>
</head>

<body>
<h1>CULTURA NAVALMORAL</h1>
    <fieldset>
        <legend>Venta de entradas</legend>
        <form action="#" method="post">

            <label for="nombre">Nombre completo</label><br>
            <input type="text" name="nombre" id="nombre"  value="<?php  echo (isset($_POST['nombre']) ? $_POST['nombre'] : '') ?>" /><br>
            <br>

            <label>Tipo Entrada:</label><br>

            <input type="radio" name="tipo" id="general" value="general" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'general') || !isset($_POST['tipo']) ? 'checked="checked"' : ''; ?>>
            <label for="general">General</label>
            <input type="radio" name="tipo" id="mayor" value="mayor" <?php recordarEntrada("tipo", "mayor"); ?>/> 
            <label for="mayor">Mayor de 60</label>
            <input type="radio" name="tipo" id="menor" value="menor" <?php recordarEntrada("tipo", "menor"); ?>/> 
            <label for="menor">Menor de 60</label><br><br>

            <label for="fecha">Fecha del Evento</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo (isset($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d')) ?>" /><br><br>

                                                                    
            <label for="entradas">Número de Entradas:</label><br>
            <input type="number" id="entradas" name="entradas" value="<?php  echo (isset($_POST['entradas']) ? $_POST['entradas'] : 1) ?>"_/>
                                                                       
            <br>

            <select name="descuentos[]" id="descuentos" multiple="multiple">
                <option>Familia Numerosa</option>
                <option>Abonado</option>
                <option>Dia del espectador</option>
                <br>
            </select><br>
            <br>

           
            <input type="submit" value="Comprar" name="comprar">

          
         
        </form>
</fieldset>

<?php
    if (isset($_POST['comprar'])) {
        if (empty($_POST['nombre']) or empty($_POST['tipo']) or empty($_POST['fecha']) or empty($_POST['entradas']) ) {
            echo "<h3 style='color:red;'>El nombre, el tipo , la fecha y las entradas son obligatorias</h3>";
        } elseif (isset($POST["entradas"]) and $_POST['entradas']<1 or $_POST['entradas']>4){
            echo "<h3 style='color:red;'> El número de entradas debe estar comprendido entre 1 y 4";
        }   
            else {
                echo '<h3> Ticket de compra</h3>';
                echo '<table border=2px>';
                echo '<tr> Nombre </tr> <br>';
                echo '<tr> Tipo de entrada </tr><br>';
                echo '<tr> Nº de entradas</tr><br>';
                echo '<tr> Descuentos </tr>';
                echo '<tr> Total a pagar</tr>';


                echo '</tr>';
 
            }
    }
    ?>
</body>

</html>