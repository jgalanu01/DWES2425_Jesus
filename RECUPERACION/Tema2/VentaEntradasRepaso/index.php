<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="" method="post">
    <fieldset>
        <legend>Venta de Entradas</legend>
        <label for="nombre">Nombre Completo</label>
        <br/>
        <input type="text" name="nombre" id="nombre" value= "<?php echo (!empty ($_POST['nombre'])? $_POST['nombre'] :''); ?>">
        <br/>
        <br/>
        <label>Tipo Entrada :</label>
        <br/>
        <input type="radio" name="tipo" id="general" value="General" checked="checked">
        <label for="general">General</label>
        <input type="radio" name="tipo" id="mayor de 60" value="Mayor de 60" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'Mayor de 60' ? "checked='checked'" :'');?>>
        <label for="mayor de 60">Mayor de 60</label>
        <input type="radio" name="tipo" id="menor de 6" value="Menor de 6 años" <?php echo (isset($_POST['tipo']) && $_POST['tipo'] == 'Menor de 6 años' ? "checked='checked'" :'');?>>
        <label for="menor de 6">Menor de 6 años</label>
        <br/>
        <br/>
        <label for="espectaculo">Espectáculo</label>
        <br/>
        <select name="espectaculo" id="espectaculo">
            <option <?php echo( isset($_POST['espectaculo']) && $_POST['espectaculo']=='Concierto' ? "selected='selected'" :'') ;?>>Concierto</option>
            <option <?php echo( isset($_POST['espectaculo']) && $_POST['espectaculo']=='Magia' ? "selected='selected'" :''); ?>>Magia</option>
            <option <?php echo( isset($_POST['espectaculo']) && $_POST['espectaculo']=='Teatro' ? "selected='selected'" :''); ?>>Teatro</option>
        </select>
        <br/>
        <br/>
        <label for="fecha">Fecha del Evento:</label>
        <br/>
        <input type="date" name="fecha" id="fecha" value="<?php echo(!empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d'));
         ?>">
        <br/>
        <br/>
        <label for="entradas">Número de Entradas:</label>
        <br/>
        <input type="number" name="entradas" id="entradas" value="<?php echo(!empty($_POST['entradas']) ? $_POST['entradas'] :'1') ;?>">
        <br/>
        <br/>
        <label for="descuento">Descuentos</label>
        <br/>
        <select name="descuento[]" id="descuento" multiple>
            <option>Familia Numerosa</option>
            <option>Abonado</option>
            <option>Día del Espectador</option>

        </select>
        <br/>

        <button type="submit" name="comprar" value="comprar">Comprar</button>
        



    </fieldset>



</form>


<?php

if(isset($_POST['comprar'])){
    if(empty($_POST['nombre']) || !isset($_POST['tipo']) || !isset($_POST['espectaculo'])|| empty($_POST['fecha'])|| empty($_POST['entradas'])){
        echo 'Hay campos sin rellenar';
    }else{
        if($_POST['entradas']<1 || $_POST['entradas']>4){
            echo 'El número de entradas debe estar entre 1  y 4';
        }else{
            if($_POST['tipo']=='Mayor de 60' && isset($_POST['descuento']) && in_array('Familia Numerosa', $_POST['descuento'])){
                echo 'El tipo de entrada mayor de 60 no es compatible con el descuento de fam numerosa';
            }else{


                ?>

                <table border=1>

                <tr>

                <th colspan="2">Ticket</th>

            </tr>

            <tr>
                <td>Nombre:</td>
                <td> <?php echo ($_POST['nombre']) ?></td>
            </tr>

            <tr>
                <td>Tipo de entrada:</td>
                <td><?php echo ($_POST['tipo'])?></td>
            </tr>

            <tr>
                <td>Nº de entradas</td>
                <td><?php echo ($_POST['entradas'])?></td>
            </tr>

            <tr>
                <td>Descuentos</td>
                <td><?php echo (isset($_POST['descuento']) ? implode('/', $_POST['descuento']):'Ninguno')?></td>
            </tr>

            </table>

            <br/>

            <?php


            echo 'Nombre:'.($_POST['nombre']).'<br/>';
            echo 'Descuentos:'.(isset($_POST['descuento']) ? implode('/' , $_POST['descuento']) : 'No hay descuentos').'<br/>';

        
?>




              

<?php
                
            }
        }
    }
}



?>
    
</body>
</html>