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

            <label>Fecha de entrada</label>
            <br />
            <input type="date" name="fechaEntrada" id="fechaEntrada" value="<?php echo !empty($_POST['fechaEntrada']) ? $_POST['fechaEntrada']:date('Y-m-d');?>">
            <br/>

            <label>Cliente</label>
            <br/>
            <input type="text" name="nombreCliente" id="nombreCliente" value="<?php echo !empty($_POST['nombreCliente']) ? $_POST['nombreCliente']:''?>">
            <br/>

            <label>Tipo de Prenda</label>
            <br/>
            <select name="tipoP">
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP']=='Hogar')  ? 'selected="selected"':'';?>>Hogar</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP']=='Fiesta')  ? 'selected="selected"':'';?> >Fiesta</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP']=='Cuero')  ? 'selected="selected"':'';?>>Cuero</option>
                <option <?php echo (isset($_POST['tipoP']) && $_POST['tipoP']=='Téxtil')  ? 'selected="selected"':'';?>>Téxtil</option>
            </select>
            </br>  
            <label for="Tipo">Servicio</label> 
            <br/>
            <input type="checkbox" name="Tipo[]" id="Limpieza" value= <?php echo (isset($_POST['Tipo'] $$ in_array('Limpieza',$_POST['Tipo']))?'selected="selected"':'';?>>Limpieza
            <input type="checkbox" name="Tipo[]" id="Planchado" value="planc">Planchado
            <input type="checkbox" name="Tipo[]" id="Desmanchado" value="desman">Desmanchado
            <br/>
            <label>Importe</label>
            <br/>
            <input type="number" name="importe" id="importe">
            <br/>
            <br/>
            <input type="button" name="Guardar" value="Guardar">




















        </fieldset>
        
    </form>
    
</body>
</html>