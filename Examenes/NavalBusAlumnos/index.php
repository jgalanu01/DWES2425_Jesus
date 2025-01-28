<?php 
require_once 'controlador.php;'
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
        <h3 style="color:red;"><?php echo (isset($mensaje)?$mensaje:'')?></h3>
     </section>

	 <?php if(!isset($_SESSION['conductor'])){?>
    <!-- Sección de Inicio de Servicio -->
	<h2>Iniciar Servicio</h2>
	<form action="" method="POST">
		<label for="linea">Línea</label>
		<?php $lineas=$bd->obtenerLineas()?>
		<select name="linea">
			<?php

			foreach($lineas as $l){
				echo '<option value="'.$l->getId().'">'.$l->getNombre().'</option>';
			}
			
			?>
		</select>
		<label for="conductor">Conductor</label>
		<?php $conductores=$bd->obtenerConductores()?>
		<input type="text" name="conductor" placeholder="Id Conductor" value="<?php echo $_SESSION['conductor']->getId()?>"/>
		<button type="submit" name="iniciar">Iniciar Servicio</button>
	</form>
	<?php }
	else if(isset($_SESSION['conductor'])){?>
	<!-- Sección de Servicio -->
	<h2>
		<?php echo $_SESSION['conductor']->getNombreApe()?>


	</h2>
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
			
			
		</table>
	</form>

<?php 
	}?>
</body>

</html>