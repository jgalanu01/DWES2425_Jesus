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
            <input type="text" name="nombre" id="nombre" value="<?php echo (!empty($_POST['nombre']) ? $_POST['nombre']: '')  ?>" >
            <br/>

            <label>Tipo Entrada:</label>
            <br/>
            <input type="radio" name="tipoEntrada" id="tipoGeneral" checked="checked" value="general"/>
            <label for="tipoGeneral">General</label>

            <input type="radio" name="tipoEntrada" id="tipoMayor" value="mayor 60"<?php echo ( isset($_POST['tipoEntrada']) && $_POST ['tipoEntrada']=='mayor 60' ?'checked="checked"' :'')  ?>/>
            <label for="tipoMayor">Mayor de 60</label>

            <input type="radio" name="tipoEntrada" id="tipoMenor" value="menor 6" <?php echo ( isset($_POST['tipoEntrada']) && $_POST ['tipoEntrada']=='menor 6' ?'checked="checked"' :'')  ?>/>
            <label for="tipoMenor">Menor de 6 años</label>
            <br />

            <label for="espectaculo">Espectáculo</label>
            <br/>
            <select name="espectaculo" id="espectaculo">
                <option <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo']=='Concierto' ? 'selected="selected"' :' ')?>>Concierto</option>
                <option <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo']=='Magia' ? 'selected="selected"' :' ')?>> Magia</option>
                <option <?php echo (isset($_POST['espectaculo']) && $_POST['espectaculo']=='Teatro' ? 'selected="selected"' :' ')?>>Teatro</option>
            </select>
            <br />


            <label for="">Fecha del Evento:</label>
            <br/>
            <input type="date" name="fechaEvento" id="fechaEvento" value="<?php echo (isset($_POST['fechaEvento']) ? $_POST['fechaEvento'] : date('Y-m-d')) ?>" /> 
            <br />

            <label for="numEntradas">Número de Entradas:</label>
            <br/>
            <input type="number" name="numEntradas" id="numEntradas"  value="<?php  echo (isset($_POST['numEntradas']) ? $_POST['numEntradas'] : '1') ?>">
            <br/>

            <label for="descuento">Descuentos</label>
            <br />
            <select name="descuento[]" id="descuento" multiple=multiple> <!-- Se pone el array siempre en el name, lo pide el examen que los descuentos son array -->
                <option>Sin descuento</option>     <!-- Esto no habia que hacerlo en el examen pero lo haremos ahora -->
                <option>Familia Numerosa</option>
                <option>Abonado</option>
                <option>Dia del Espectador</option>
            </select>
        <br/>
            <button type="submit" id="comprar">Comprar</button>
        </fieldset>
    </form>

</body>

</html>