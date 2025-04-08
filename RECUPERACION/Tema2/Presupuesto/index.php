<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="post">

        <label for="tipoC">Tipo de cliente</label>
        <br />
        <select name="tipoC" id="tipoC">
            <option selected="selected">Empresa</option>
            <option <?php echo (isset($_POST['tipoC']) && $_POST['tipoC'] == 'Particular') ? "selected='selected'" : ''; ?>>Particular</option>
            <option <?php echo (isset($_POST['tipoC']) && $_POST['tipoC'] == 'Organismo Público')  ? "selected='selected'" : ''; ?>>Organismo Público</option>
        </select>
        <br />
        <br />

        <label for="nombre">Nombre Cliente</label>
        <br />
        <input type="text" name="nombre" id="nombre" value="<?php echo (!empty($_POST['nombre'])  ?  $_POST['nombre'] : ''); ?>">
        <br />

        <label for="correo">Email</label>
        <br />
        <input type="email" name="correo" id="correo" value="<?php echo (!empty($_POST['correo']) ? $_POST['correo'] : ''); ?>">
        <br />

        <label>Tipo de Motor</label>
        <br />

        <input type="radio" name="tipoM" id="diesel" value="diesel" <?php echo (isset($_POST['tipoM']) && ($_POST['tipoM'] == 'diesel')  ? "checked='checked'"     : '') ?>>
        <label for="diesel">Diesel</label>
        <input type="radio" name="tipoM" id="gasolina" value="gasolina" <?php echo (isset($_POST['tipoM']) && ($_POST['tipoM'] == 'gasolina')  ? "checked='checked'"     : '') ?>>
        <label for="gasolina">Gasolina</label>
        <input type="radio" name="tipoM" id="electrico" value="electrico" <?php echo (isset($_POST['tipoM']) && ($_POST['tipoM'] == 'electrico')  ? "checked='checked'"     : '') ?>>
        <label for="electrico">Eléctrico</label>
        <br />
        <br />

        <label>Opciones</label>
        <br />
        <input type="checkbox" name="opciones[]" id="climatizador" value="climatizador">
        <label for="climatizador">Climatizador</label>
        <input type="checkbox" name="opciones[]" id="gps" value="gps">
        <label for="gps">Gps</label>
        <input type="checkbox" name="opciones[]" id="camara" value="camara">
        <label for="camara">Cámara</label>
        <br />
        <br />

        <label for="tipoV">Selecciona vehículo</label>
        <br />
        <select name="tipoV" id="tipoV">
            <option selected="selected">Volkswagen Golf</option>
            <option <?php echo (isset($_POST['tipoV']) && ($_POST['tipoV'] == 'Opel Astra')  ? "selected='selected'" : '') ?>>Opel Astra</option>
            <option <?php echo (isset($_POST['tipoV']) && ($_POST['tipoV'] == 'Ford Mondeo')  ? "selected='selected'" : '') ?>>Ford Mondeo</option>
        </select>
        <label for="precio">Precio €</label>
        <input type="number" name="precio" id="precio" value="<?php echo (!empty($_POST['precio']) ? $_POST['precio']  : '1') ?>">
        <br />
        <br />

        <label for="promocion">Selecciona promoción</label>
        <br />
        <select name="promocion" id="promocion">
            <option selected="selected">Sin promoción</option>
            <option <?php echo (isset($_POST['promocion']) && ($_POST['promocion'] == 'Plan green energy(-2500€)')  ? "selected='selected'" : '') ?>>Plan green energy(-2500€)</option>
            <option <?php echo (isset($_POST['promocion']) && ($_POST['promocion'] == 'Plan renove(-2000)')  ? "selected='selected'" : '') ?>>Plan renove(-2000)</option>

        </select>
        <br />
        <br />

        <button type="submit" name="enviar">Enviar</button>

    </form>

    <?php

    if(isset($_POST['enviar'])){
        if(empty($_POST['nombre']) || empty ($_POST['correo']) || empty($_POST['precio'])  ){
            echo 'Los campos no pueden estar vacios';
        }else{
            if(isset($_POST['tipoM']) && $_POST['tipoM']=='diesel' && isset($_POST['promocion']) && $_POST['promocion']=='Plan green energy(-2500€)'){
                echo 'No puedes seleccionar diesel con esa promoción';
            }
        }

    }




?>

</body>

</html>