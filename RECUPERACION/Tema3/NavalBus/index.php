<?php
require_once 'controlador.php';

//Si no hay conexión no va a mostrar nada

if ($bd->getConexion() == null) {

    echo ('No se ha establecido la conexión con la BD:' . $mensaje);
} else {

	?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>NavalBus</title>
</head>

<body>
    <h1>NavalBus</h1>

     <!-- Sección de Mensajes -->
	 <section>
            <h3 style="color:red"><?php echo (isset($mensaje) ? $mensaje : '') ?></h3>
        </section>

		<?php

		if(!isset($_SESSION['conductor'])){

	


		?>
    <!-- Sección de Inicio de Servicio -->
	<h2>Iniciar Servicio</h2>
	<form action="" method="POST">
		<label for="linea">Línea</label>
		<select name="linea">
		</select>
		<label for="conductor">Conductor</label>
		<input type="text" name="conductor" placeholder="Id Conductor" />
		<button type="submit" name="iniciar">Iniciar Servicio</button>
	</form>

	<?php

}else{


	?>
	



	<!-- Sección de Servicio -->
	<h2>Conductor:</h2>
	<form method="post">
		<h4 style="color:blue">Tipo de Billete</h4>
		<select name="tipo">
			<option selected="selected">General</option>
			<option>Reducido</option>
		</select>
		<button type="submit" name="vender">Vender</button>
		<button type="submit" name="fin">Finalizar Servicio</button>
		<h3 style="color:blue">Recaudado:</h3>
		<table width="100%">
			<tr>
				<td>
					<h3 style="color:blue">Fecha</h3>
				</td>
				<td>
					<h3 style="color:blue">Línea</h3>
				</td>
				<td>
					<h3 style="color:blue">Tipo Billete</h3>
				</td>
				<td>
					<h3 style="color:blue">Precio</h3>
				</td>
			</tr>
			
		</table>
	</form>

	<?php
}
?>
</body>

</html>

<?php

}

?>