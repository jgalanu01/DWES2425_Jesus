<?php
require_once 'Usuario.php';
require_once 'Cliente.php';
require_once 'AD.php';

?>
<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Recuperación 22_23</title>
</head>

<body>
	<?php
	$bd = new AD(); // Ejercicio 1: Se crea una instancia de la clase AD para manejar la conexión a la base de datos.
	if ($bd->getConexion() == null) { // Ejercicio 1: Verifica si la conexión con la base de datos es válida. Si no lo es, muestra un mensaje de error.
		$mensaje = 'Error, no hay conexión con la base de datos mensajes';
	} else {
		if (isset($_POST['acceder'])) {
			// Obtener los datos del usuario logueado
			$u = $bd->obtenerUsuario($_POST['usuario'], $_POST['ps']); // Ejercicio 1: Se obtienen los datos del usuario ingresado en el formulario de inicio de sesión.
			if ($u != null) { // Ejercicio 1: Comprueba si las credenciales del usuario son correctas.
				session_start();
				$_SESSION['usuario'] = $u;
				// Verificar el tipo de usuario
				if ($u->getTipo() == 'A') { // Ejercicio 1: Si el usuario es administrador (tipo 'A'), redirige a la página crearCliente.php.
					header("location:crearCliente.php");
				} elseif ($u->getTipo() == 'C') { // Ejercicio 1: Si el usuario es cliente (tipo 'C'), verifica si está dado de baja antes de redirigir a misActividades.php.
					$c = $bd->obtenerCliente($u->getUsuario());
					if ($c->getBaja()) {
						$mensaje = 'Error, el usuario está dado de baja';
					} else {
						header("location:misActividades.php");
					}
				}
			} else {
				$mensaje = 'Error, datos incorrectos'; // Ejercicio 1: Muestra un mensaje de error si las credenciales ingresadas son incorrectas.
			}
		}
	}
	?>
	<div>
		<h1 style='color:red;'><?php if (isset($mensaje)) {
									echo $mensaje;
								} ?></h1>
	</div>
	<form action="login.php" method="post">
		<h1>SuperGim</h1>
		<div>
			<label for="usuario">Usuario</label><br />
			<input type="text" id="usuario" name="usuario" />
		</div>
		<div>
			<label for="ps">Contraseña</label><br />
			<input type="password" id="ps" name="ps" />
		</div>
		<br /><button type="submit" name="acceder">Acceder</button>
	</form>
</body>

</html>