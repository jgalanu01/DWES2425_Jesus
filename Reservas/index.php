<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">
        <label for="nombre">Nombre</label>
        <br />
        <input type="text" name="nombre" id="nombre" value="<?php echo (!empty($_POST['nombre']) ? $_POST['nombre']  : ''); ?>">
        <br />
        <label for="fecha">Fecha</label>
        <br />
        <input type="date" name="fecha" id="fecha" value="<?php echo (!empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d')); ?>">
        <br />
        <label for="hora">Hora</label>
        <br />
        <input type="time" name="hora" id="hora" value="<?php echo (!empty($_POST['hora']) ? $_POST['hora'] : date('H:i')); ?>">
        <br />
        <label for="nPersonas">Número de personas</label>
        <br />
        <input type="number" name="nPersonas" id="nPersonas" value="<?php echo (!empty($_POST['nPersonas']) ? $_POST['nPersonas']  : '2'); ?>">
        <br />
        <label for="zonaP">Zona preferida</label>
        <br />
        <select name="zonaP" id="zonaP">
            <option <?php echo (isset($_POST['zonaP']) && ($_POST['zonaP'] == 'Interior') ? "selected='selected'" : '') ?>>Interior</option>
            <option <?php echo (isset($_POST['zonaP']) && ($_POST['zonaP'] == 'Terraza') ? "selected='selected'" : '') ?>>Terraza</option>
            <option <?php echo (isset($_POST['zonaP']) && ($_POST['zonaP'] == 'Reservado') ? "selected='selected'" : '') ?>>Reservado</option>
        </select>
        <br />
        <label>Reserva para</label>
        <br />
        <input type="radio" name="reserva" id="Menu" value="Menu" <?php echo (isset($_POST['reserva']) && $_POST['reserva'] == 'Menu' ? "checked='checked'" : '') ?>>
        <label for="Menu">Menú</label>
        <input type="radio" name="reserva" id="Carta" value="Carta" <?php echo (isset($_POST['reserva']) && $_POST['reserva'] == 'Carta' ? "checked='checked'" : '') ?>>
        <label for="Carta">Carta</label>
        <br />
        <label>Preferencias alimentarias: </label>
        <input type="checkbox" name="preferencias[]" id="Vegano" value="Vegano">
        <label for="Vegano">Vegano</label>
        <input type="checkbox" name="preferencias[]" id="Celiaco" value="Celiaco">
        <label for="Celiaco">Celiaco</label>
        <input type="checkbox" name="preferencias[]" id="Sin lactosa" value="Sin lactosa">
        <label for="Sin lactosa">Sin lactosa</label>
        <br />
        <br />
        <button type="submit" name="Reservar" value="Reservar">Reservar</button>
        <button type="submit" name="Borrar" value="Borrar">Borrar</button>




    </form>

    <?php
    if (isset($_POST["Reservar"])) {
        if (empty($_POST['nombre']) || empty($_POST['fecha']) || empty($_POST['hora']) || empty($_POST['nPersonas']) || !isset($_POST['zonaP']) || !isset($_POST['reserva'])) {
            echo 'Error, hay campos sin rellenar';
        } else {
            if (isset($_POST['zonaP']) && $_POST['zonaP'] == 'Terraza' && isset($_POST['reserva']) && $_POST['reserva'] == 'Menu') {
                echo 'No se puede seleccionar zona de terraza con la reserva de Menú';
            } else {

                if ($_POST['reserva'] == 'Menu' && isset($_POST['preferencias']) &&  in_array('Sin lactosa', $_POST['preferencias'])) {

                    echo 'No puedes seleccionar Menú y sin lactosa a la vez';
                } else {

                    if ($_POST['nPersonas'] < 2) {
                        echo 'El número de personas debe ser mayor de 2';
                    } else {
                        if ($_POST['nPersonas'] > 8 && ($_POST['zonaP']) == "Terraza") {
                            echo 'En terraza no se puede seleccionar mas de 8 personas';
                        } else {

    ?>

                            <table border=1>
                                <tr>
                                    <th>Nombre</th>
                                    <td><?php echo ($_POST['nombre'])  ?></td>
                                </tr>
                                <tr>
                                    <th>Fecha Reserva</th>
                                    <td><?php echo ($_POST['fecha'])  ?></td>
                                </tr>
                                <tr>
                                    <th>Hora</th>
                                    <td><?php echo  $_POST['hora']   ?></td>
                                </tr>
                                <tr>
                                    <th>Nº de personas</th>
                                    <td><?php echo $_POST['nPersonas']  ?></td>
                                </tr>
                                <tr>
                                    <th>Zona</th>
                                    <td><?php echo $_POST['zonaP'] ?></td>
                                </tr>
                                <tr>
                                    <th>Reserva para</th>
                                    <td><?php echo $_POST['reserva']  ?></td>
                                </tr>
                                <tr>
                                    <th>Preferencias Alimentarias</th>
                                    <td><?php echo (isset($_POST['preferencias']) ? implode(',', $_POST['preferencias']) : 'Ninguna') ?> </td>
                                </tr>
                            </table>





    <?php
                        }
                    }
                }
            }
        }
    }



    ?>


</body>

</html>