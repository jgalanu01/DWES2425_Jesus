<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">

        <h3>Tintoreria la Morada</h3>
        <fieldset>
            <legend>Registrar Trabajo</legend>

            <label for="fechaEntrada">Fecha de entrada</label>
            <br />
            <input type="date" name="fechaEntrada" id="fechaEntrada" value="<?php echo isset($_POST['fechaEntrada']) ? $_POST['fechaEntrada'] : date('Y-m-d'); ?>">
            <br />

            <label>Cliente</label>
            <br />
            <input type="text" name="nombreCliente" id="nombreCliente" value="<?php echo !empty($_POST['nombreCliente']) ? $_POST['nombreCliente'] : '' ?>">
            <br />

            <label>Tipo de Prenda</label>
            <br />
            <select name="tipoP">
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP'] == 'Hogar')  ? 'selected="selected"' : ''; ?>>Hogar</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP'] == 'Fiesta')  ? 'selected="selected"' : ''; ?>>Fiesta</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP'] == 'Cuero')  ? 'selected="selected"' : ''; ?>>Cuero</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP'] == 'Téxtil')  ? 'selected="selected"' : ''; ?>>Téxtil</option>
            </select>
            </br>
            <label for="Tipo">Servicio</label>
            <br />
            <input type="checkbox" name="Tipo[]" id="Limpieza" value="Limpieza" <?php echo (isset($_POST['Tipo']) && in_array('Limpieza', $_POST['Tipo'])) ? 'checked="checked"' : ''; ?>>Limpieza
            <input type="checkbox" name="Tipo[]" id="Planchado" value="Planchado" <?php echo (isset($_POST['Tipo']) && in_array('Planchado', $_POST['Tipo'])) ? 'checked="checked"' : ''; ?>>Planchado
            <input type="checkbox" name="Tipo[]" id="Desmanchado" value="Desmanchado" <?php echo (isset($_POST['Tipo']) && in_array('Desmanchado', $_POST['Tipo'])) ? 'checked="checked"' : ''; ?>>Desmanchado
            <br />
            <label for="importe">Importe</label>
            <br />
            <input type="number" name="importe" id="importe" value="<?php echo (!empty($_POST['importe'])) ? $_POST['importe'] : '1' ?>">
            <br />
            <br />
            <button type="submit" name="Guardar">Guardar</button>





        </fieldset>

    </form>

    <?php

    if (isset($_POST['Guardar'])) {
        if (!isset($_POST['fechaEntrada']) || empty($_POST['nombreCliente']) || !isset($_POST['tipoP']) || !isset($_POST['importe'])) {
            echo 'Debe completar los campos';
        } else {
            if (!isset($_POST['Tipo'])) {
                echo 'Debe marcar al menos un servicio';
            } else {
                if ($_POST['tipoP'] == 'Cuero' && isset($_POST['Tipo']) && in_array('Planchado', $_POST['Tipo'])) {
                    echo 'No se puede seleccionar cuero con planchado';
                }else{
                    if($_POST['tipoP']=='Fiesta' && $_POST['importe']<50){
                        echo 'Las prendas de fiesta valen mínimo 50€';
                    }else{
                        echo 'Datos correctos'.'<br/>';
                        echo 'Prenda:'. $_POST['tipoP'].'<br>';
                        echo 'Servicio:'.implode('/',$_POST['Tipo']).'<br>';
                    }
                }
            }
        }
    }





    ?>

</body>

</html>