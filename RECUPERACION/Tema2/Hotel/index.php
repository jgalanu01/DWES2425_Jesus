<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
<label for="dni">Dni</label>
<br/>
<input type="text" name="dni" id="dni" value="<?php echo(!empty($_POST['dni'])   ?$_POST['dni'] :  ''  );   ?>">
<br/>

<label for="nombre">Nombre del cliente</label>
<br/>
<input type="text" name="nombre" id="nombre" value="<?php echo  (!empty($_POST['nombre'])?$_POST['nombre'] :'');?>">
<br/>
<br/>

<label for="tipoH">Tipo de habitación</label>
<br/>
<select name="tipoH" id="tipoH">
<option selected="selected">Doble</option>
<option <?php echo (isset($_POST['tipoH']) && $_POST['tipoH']=='Individual' ? "selected='selected'" :''); ?>>Individual</option>
<option <?php echo (isset($_POST['tipoH']) && $_POST['tipoH']=='Suite' ? "selected='selected'" :''); ?>>Suite</option>
</select>
<br/>
<br/>

<label for="noches">Nº de Noches</label>
<br/>
<input type="number" name="noches" id="noches" value="<?php echo (!empty ($_POST['noches']) ? $_POST['noches']:'1');       ?>">
<br/>

<label for="estancia">Estancia</label>
<br/>
<select name="estancia" id="estancia">
<option selected="selected">Diario</option>
<option <?php echo (isset($_POST['estancia']) && $_POST['estancia']=='Fin de semana' ? "selected='selected'" :'');?>>Fin de semana</option>
<option <?php echo (isset($_POST['estancia']) && $_POST['estancia']=='Promocionado' ? "selected='selected'" :'');?>>Promocionado</option>
</select>
<br/>
<br/>


<label>Pago</label>
<br/>
<input type="radio" name="tipoP" id="Tarjeta" value="Tarjeta" checked="checked">
<label for="Tarjeta">Tarjeta</label>
<input type="radio" name="tipoP" id="Efectivo" value="Efectivo" <?php echo (isset($_POST['tipoP']) && $_POST['tipoP']=='Efectivo' ? "checked='checked'":''); ?>>
<label for="Efectivo">Efectivo</label>

<br/>
<br/>
<label>Opciones</label>
<br/>
<input type="checkbox" name="opciones[]" id="cuna" value="Cuna">
<label for="cuna">Cuna</label>
<input type="checkbox" name="opciones[]" id="cama" value="Cama Supletoria">
<label for="cama">Cama Supletoria</label>
<input type="checkbox" name="opciones[]" id="lavanderia" value="Lavanderia">
<label for="lavanderia">Lavanderia</label>
<br/>
<button type="submit" name="crear" value="Crear Estancia">Crear Estancia</button>
<br/>


<?php 
if (isset($_POST['crear'])) {
    if (empty($_POST['dni']) || empty($_POST['nombre']) || empty($_POST['noches'])) {
        echo '<p style="color:red;">Error, campos vacíos</p>';
    } else {
        if ($_POST['noches'] > 2 && isset($_POST['tipoP']) && $_POST['tipoP'] == 'Efectivo') {
            echo '<p style="color:red;">No puedes seleccionar pago en efectivo si tu estancia son más de 2 noches.</p>';
        } else {
            if (isset($_POST['opciones']) && in_array('Cuna', $_POST['opciones']) && in_array('Cama Supletoria', $_POST['opciones'])) {
                echo '<p style="color:red;">No se puede seleccionar cuna y cama supletoria a la vez.</p>';
            } else {
                $total = 0;

                if ($_POST['tipoH'] == 'Individual') {
                    $total = 45 * $_POST['noches'];
                } else {
                    if ($_POST['tipoH'] == 'Doble') {
                        $total = 55 * $_POST['noches'];
                    } else {
                        if ($_POST['tipoH'] == 'Suite') {
                            $total = 75 * $_POST['noches'];
                        }
                    }
                }

                if ($_POST['estancia'] == 'Fin de semana') {
                    $total += $total * 0.10;
                } else {
                    if ($_POST['estancia'] == 'Promocionado') {
                        $total -= $total * 0.10;
                    }
                }

                echo "<p>El precio final es de: <strong>$total €</strong></p>";

                
            }
        }
    }
}
?>









</form>
    
</body>
</html>