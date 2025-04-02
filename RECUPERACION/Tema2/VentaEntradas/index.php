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
            <br/>
            <input type="text" name="nombre" id="nombre" value="<?php echo !empty($_POST['nombre']) ? $_POST['nombre'] : ''; ?>">
            <br/>

            <label>Tipo Entrada:</label>
            <br/>
            <input type="radio" name="tipoEntrada" id="tipoGeneral" value="general" checked>
            <label for="tipoGeneral">General</label>

            <input type="radio" name="tipoEntrada" id="tipoMayor" value="mayor 60" <?php echo (isset($_POST['tipoEntrada']) && $_POST['tipoEntrada'] == 'mayor 60') ? 'checked' : ''; ?>>
            <label for="tipoMayor">Mayor de 60</label>

            <input type="radio" name="tipoEntrada" id="tipoMenor" value="menor 6" <?php echo (isset($_POST['tipoEntrada']) && $_POST['tipoEntrada'] == 'menor 6') ? 'checked' : ''; ?>>
            <label for="tipoMenor">Menor de 6 años</label>
            <br />

            <label for="espectaculo">Espectáculo</label>
            <br/>
            <select name="espectaculo" id="espectaculo">
                <option value="Concierto" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Concierto') ? 'selected' : ''; ?>>Concierto</option>
                <option value="Magia" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Magia') ? 'selected' : ''; ?>>Magia</option>
                <option value="Teatro" <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo'] == 'Teatro') ? 'selected' : ''; ?>>Teatro</option>
            </select>
            <br />

            <label for="fechaEvento">Fecha del Evento:</label>
            <br/>
            <input type="date" name="fechaEvento" id="fechaEvento" value="<?php echo isset($_POST['fechaEvento']) ? $_POST['fechaEvento'] : date('Y-m-d'); ?>"> 
            <br />

            <label for="numEntradas">Número de Entradas:</label>
            <br/>
            <input type="number" name="numEntradas" id="numEntradas" min="1" max="4" value="<?php echo isset($_POST['numEntradas']) ? $_POST['numEntradas'] : '1'; ?>">
            <br/>

            <label for="descuento">Descuentos</label><br/>
            <select name="descuento[]" id="descuento" multiple>
                <option value="familia numerosa" <?php echo (isset($_POST['descuento']) && in_array('familia numerosa', $_POST['descuento'])) ? 'selected' : ''; ?>>Familia Numerosa</option>
                <option value="abonado" <?php echo (isset($_POST['descuento']) && in_array('abonado', $_POST['descuento'])) ? 'selected' : ''; ?>>Abonado</option>
                <option value="dia del espectador" <?php echo (isset($_POST['descuento']) && in_array('dia del espectador', $_POST['descuento'])) ? 'selected' : ''; ?>>Día del Espectador</option>
            </select>
            <br/>
            <button type="submit" name="comprar">Comprar</button>
        </fieldset>
    </form>
</body>

<?php
if (isset($_POST['comprar'])) {
    if (empty($_POST['nombre']) || empty($_POST['tipoEntrada']) || empty($_POST['espectaculo']) || empty($_POST['fechaEvento']) || empty($_POST['numEntradas'])) {
        echo "<p style='color:red;'>Debe completar todos los campos.</p>";
    } else {
        $numEntradas = intval($_POST['numEntradas']);
        if ($numEntradas < 1 || $numEntradas > 4) {
            echo "<p style='color:red;'>El número de entradas debe ser entre 1 y 4.</p>";
        } else {
            if ($_POST['tipoEntrada'] == 'mayor 60' && isset($_POST['descuento']) && in_array('familia numerosa', $_POST['descuento'])) {
                echo "<p style='color:red;'>El descuento de familia numerosa no es compatible con la entrada para mayores de 60 años.</p>";
            } else {
                $precios = ['general' => 10, 'mayor 60' => 8, 'menor 6' => 5];
                $total = $precios[$_POST['tipoEntrada']] * $numEntradas;
                ?>
                <table border=1>
                    <tr>
                        <th colspan="2">TICKET DE COMPRA</th>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo htmlspecialchars($_POST['nombre']); ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de entrada</td>
                        <td><?php echo htmlspecialchars($_POST['tipoEntrada']); ?></td>
                    </tr>
                    <tr>
                        <td>Nº de entradas</td>
                        <td><?php echo $numEntradas; ?></td>
                    </tr>
                    <tr>
                        <td>Descuentos</td>
                        <td><?php echo isset($_POST['descuento']) ? implode(' / ', $_POST['descuento']) : 'Ninguno'; ?></td>
                    </tr>
                    <tr>
                        <td>Total a pagar</td>
                        <td><?php echo $total; ?>€</td>
                    </tr>
                </table>
                <?php
            }
        }
    }
}
?>
</html>