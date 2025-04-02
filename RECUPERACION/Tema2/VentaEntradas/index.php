<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Venta de Entradas</title>
</head>

<body>
    <form action="" method="post">
        <fieldset>
            <legend>Venta de Entradas</legend>
            <label for="nombre">Nombre Completo</label>
            <br />
            <input type="text" name="nombre" id="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
            <br />

            <label>Tipo Entrada:</label>
            <br />
            <input type="radio" name="tipoEntrada" id="tipoGeneral" value="general" checked="checked">
            <label for="tipoGeneral">General</label>

            <input type="radio" name="tipoEntrada" id="tipoMayor" value="mayor 60" <?php echo (isset($_POST['tipoEntrada']) && $_POST['tipoEntrada'] == 'mayor 60') ? 'checked="checked"' : ''; ?>>
            <label for="tipoMayor">Mayor de 60</label>

            <input type="radio" name="tipoEntrada" id="tipoMenor" value="menor 6" <?php echo (isset($_POST['tipoEntrada']) && $_POST['tipoEntrada'] == 'menor 6') ? 'checked="checked"' : ''; ?>>
            <label for="tipoMenor">Menor de 6 años</label>
            <br />

            <label for="espectaculo">Espectáculo</label>
            <br />
            <select name="espectaculo" id="espectaculo">
                <option value="Concierto" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Concierto') ? 'selected="selected"' : ''; ?>>Concierto</option>
                <option value="Magia" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Magia') ? 'selected="selected"' : ''; ?>>Magia</option>
                <option value="Teatro" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Teatro') ? 'selected="selected"' : ''; ?>>Teatro</option>
            </select>
            <br />

            <label for="fechaEvento">Fecha del Evento:</label>
            <br />
            <input type="date" name="fechaEvento" id="fechaEvento" value="<?php echo isset($_POST['fechaEvento']) ? $_POST['fechaEvento'] : date('Y-m-d'); ?>">
            <br />

            <label for="numEntradas">Número de Entradas:</label>
            <br />
            <input type="number" name="numEntradas" id="numEntradas" value="<?php echo (!empty($_POST['numEntradas']) ? $_POST['numEntradas'] : '1') ?>">
            <br />

            <label for="descuento">Descuentos</label><br />
            <select name="descuento[]" id="descuento" multiple>
                <option <?php echo (isset($_POST['descuento']) && in_array('Familia Numerosa', $_POST['descuento'])) ? 'selected="selected"' : ''; ?>>Familia Numerosa</option>
                <option <?php echo (isset($_POST['descuento']) && in_array('Abonado', $_POST['descuento'])) ? 'selected="selected"' : ''; ?>>Abonado</option>
                <option <?php echo (isset($_POST['descuento']) && in_array('Dia del Espectador', $_POST['descuento'])) ? 'selected="selected"' : ''; ?>>Día del Espectador</option>
            </select>
            <br />
            <button type="submit" name="comprar">Comprar</button>
        </fieldset>
    </form>
</body>

<?php
if (isset($_POST['comprar'])) {
    if (empty($_POST['nombre']) || !isset($_POST['tipoEntrada']) || !isset($_POST['espectaculo']) || !isset($_POST['fechaEvento']) || !isset($_POST['numEntradas'])) {
        echo "<p style='color:red;'>Debe completar todos los campos.</p>";
    } else {
        if ($_POST['numEntradas'] < 1 || ($_POST['numEntradas'] > 4)) {
            echo "<p style='color:red;'>El número de entradas debe ser entre 1 y 4.</p>";
        } else {
            if ($_POST['tipoEntrada'] == 'mayor 60' && isset($_POST['descuento']) && in_array('Familia Numerosa', $_POST['descuento'])) {
                echo "<p style='color:red;'>El descuento de familia numerosa no es compatible con la entrada para mayores de 60 años.</p>";
            } else {
                $total = 0;

                if ($_POST['tipoEntrada'] == 'general') {
                    $total = 10 * ($_POST['numEntradas']);
                } elseif ($_POST['tipoEntrada'] == 'mayor 60') {
                    $total = 8 * ($_POST['numEntradas']);
                } else {
                    $total = 5 * ($_POST['numEntradas']);
                }

?>
                <table border=1>
                    <tr>
                        <th colspan="2">TICKET DE COMPRA</th>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo $_POST['nombre'] ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de entrada</td>
                        <td><?php echo $_POST['tipoEntrada']?></td>
                    </tr>
                    <tr>
                        <td>Nº de entradas</td>
                        <td><?php echo $_POST['numEntradas'] ?></td>
                    </tr>
                    <tr>
                        <td>Descuentos</td>
                        <td><?php echo isset($_POST['descuento']) ? implode(' / ', $_POST['descuento']) : 'Ninguno'; ?></td>
                    </tr>
                    <tr>
                        <td>Total a pagar</td>
                        <td><?php echo $total?>€</td>
                    </tr>
                </table>
<?php
            }
        }
    }
}
?>

</html>