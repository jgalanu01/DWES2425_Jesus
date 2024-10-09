<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h3>Tintorería La Morada</h3>
<form action="" method="post">
    <p>
        <label>Fecha de entrada</label>
        <br>
        <input type="date" name="fecha"value="<?php echo date('Y-m-d');?>"/>


    </p>

    <p>
        <label>Cliente</label>
        <br>
        <input type="text" name="nombre" placeholder="Teclea nombre"/>

    </p>
    <p>
        <label>Tipo de prenda</label>
        <br>
        <select name="tipoP">
    			<option>Fiesta</option>
    			<option>Cuero</option>
                <option>Hogar</option>
                <option selected="selected">Téxtil</option>
    		</select>
        
    </p>
    <p>

    <label>Servicio</label>
    <br>
    		<input type="checkbox" name="Limpieza" value="limp"/>Limpieza
    		<input type="checkbox" name="Planchado" value="planc"/>Planchado
    		<input type="checkbox" name="Desmanchado" value="desm"/>Desmanchado
		</p>

        <p>
            <label>Importe</label>
            <br>
            <input type="number" name="importe"/>

        </p>

        <p>
            <input type="submit" name="Guardar" value="Guardar">
        </p>

</form>

<?php 
	if(isset($_POST["Guardar"])){
	    //campos que no pueden estar vacíos
	    if(empty($_POST["fecha"]) or 
	        empty($_POST["nombre"]) or empty($_POST["tipoP"]) or empty($_POST["importe"])){
	        $mensaje="Error, la fecha, el cliente, el tipo de prenda y el importe no pueden estar vacíos";
	    }
        if(empty($_POST["Limpieza"]) && ($_POST["Planchado"]) && ($_POST["Desmanchado"])){
            $mensaje="Error , tiene que haber mínimo un servicio marcado";
        }
        if($_POST["tipoP"]=="Cuero" and $_POST["Planchado"]=="planc") {
	        
	        $mensaje="Error, el tipo de prenda no es compatible con el servicio planchado";
	    }

        if($_POST["tipoP"]=="Fiesta" and $_POST["importe"] <"50"){
	        $mensaje="Error, las prendas de fiesta tienen un precio mínimo de 50 euros";
	    }






        if(isset($mensaje)){
	        echo $mensaje;
	    }
        else{
	        echo"Datos correctos";
            ?>
            <p>
            <?php
           echo"Prenda:".$_POST["tipoP"];
           ?>
           <p>
            <?php
           
           

	    }

    }

    ?>
    
</body>
</html>