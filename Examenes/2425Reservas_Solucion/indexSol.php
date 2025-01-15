<?php
require_once 'controlador.php';

function seleccionado($id)
{
    // Parte del Ejercicio 3 - Función para recordar el recurso seleccionado
    // Si el id del recurso coincide con el valor enviado por POST, se marca como seleccionado
    if (isset($_POST['recurso']) and $_POST['recurso'] == $id) {
        return 'selected="selected"';
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservas IES Augustóbriga</title>
</head>

<body>
    <h1>Reservas IES Augustóbriga</h1>

    <!-- Parte del Ejercicio 1 - Login: Formulario de Login -->
    <?php if (!isset($_SESSION['usuario'])) { ?>
        <!-- Sección de Login visible cuando no hay usuario autenticado -->
        <section>
            <h2>Login</h2>
            <form action="" method="POST">
                <label for="usuario">Usuario</label><br />
                <input type="text" name="usuario" /><br />
                <label for="ps">Contraseña</label><br />
                <input type="password" name="ps"><br /><br />
                <button type="submit" name="acceder">Acceder</button>
            </form>
        </section>
    <?php } ?>

    <!-- Sección de Mensajes: Mostrar posibles errores si es necesario -->
    <section>
        <?php if (isset($mensaje)) {
            echo '<h3 style="color:red">' . $mensaje . '</h3>';
        } ?>
    </section>

    <!-- Parte del Ejercicio 1 - Información del usuario autenticado -->
    <?php if (isset($_SESSION['usuario'])) { ?>
        <!-- Sección visible cuando el usuario está logueado -->
        <form method="post">
            <section>
                <table width="100%">
                    <tr>
                        <td>
                            <h3 style="color:blue">Id Rayuela</h3><?php echo $_SESSION['usuario']->getIdRayuela() ?>
                        </td>
                        <td>
                            <h3 style="color:blue">Nombre</h3><?php echo $_SESSION['usuario']->getNombre() ?>
                        </td>
                        <td>
                            <h3 style="color:blue">Número de Reservas</h3><?php echo $_SESSION['usuario']->getNumReservas() ?>
                        </td>
                        <td>
                            <h3 style="color:blue">Color Reservas</h3>

                            <!-- Parte del Ejercicio 2 - Opción para cambiar el color de las reservas -->
                            <!-- Se guarda el color seleccionado en una cookie y se recuerda en próximos accesos -->
                            <input type="color" name="color" value="<?php echo (isset($_COOKIE['colorR']) ? $_COOKIE['colorR'] : '#FF0000') ?>" />
                            <input type="submit" name="cambiarColor" value="cambiar" />
                        </td>
                        <td>
                            <!-- Parte del Ejercicio 2 - Opción para cerrar sesión -->
                            <!-- Al pulsar el botón "Salir" se destruye la sesión y el usuario es redirigido a la página de inicio -->
                            <input type="submit" name="salir" value="Salir" />
                        </td>
                    </tr>
                </table>
            </section>

            <!-- Parte del Ejercicio 3 - Mostrar recursos y reservas -->
            <section>
                <h3 style="color:blue">Selecciona Recurso</h3>
                <select name="recurso">
                    <?php
                    $recursos = $bd->obtenerRecursos();
                    foreach ($recursos as $r) {
                        // Parte del Ejercicio 3 - Recordar recurso seleccionado
                        echo '<option value="' . $r->getId() . '" ' . seleccionado($r->getId()) . '>' . $r->getNombre() . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="verR" value="verReservas" />
                <table width="50%">
                    <tr>
                        <td>Id</td>
                        <td>Usuario</td>
                        <td>Recurso</td>
                        <td>Fecha</td>
                        <td>Hora</td>
                    </tr>
                    <?php
                    if (!empty($_POST['recurso'])) {
                        $reservas = $bd->obtenerReservasActivas($_POST['recurso']);
                        foreach ($reservas as $r) {
                            // Parte del Ejercicio 3 - Color de las reservas del usuario basado en la cookie
                            if ($r->getUsuario()->getIdRayuela() == $_SESSION['usuario']->getIdRayuela()) {
                                echo '<tr style="color:' . (isset($_COOKIE['colorR']) ? $_COOKIE['colorR'] : 'black') . '">'; // Color de las reservas basado en la cookie
                            } else {
                                echo '<tr>';
                            }
                            echo '<td>' . $r->getId() . '</td>';
                            echo '<td>' . $r->getUsuario()->getNombre() . '</td>';
                            echo '<td>' . $r->getRecurso()->getNombre() . '</td>';
                            echo '<td>' . $r->getFecha() . '</td>';
                            echo '<td>' . $r->getHora() . '</td>';
                            echo '</tr>';
                        }
                    }
                    ?>
                </table>
            </section>

            <!-- Parte del Ejercicio 1 - Crear o anular una reserva -->
            <section>
                <h3 style="color:blue">Crear/Anular Reserva</h3>
                <label for="fecha">Fecha Reserva</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>" />
                <label for="hora">Hora Reserva</label>
                <select name="hora" id="hora">
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                    <option value="3">Tercera</option>
                    <option value="4">Cuarta</option>
                    <option value="5">Quinta</option>
                    <option value="6">Sexta</option>
                </select>
                <button type="submit" name="reservar">Reservar</button>
                <button type="submit" name="anular">Anular</button>
            </section>

            <!-- Parte del Ejercicio 4 - Formulario para crear una nueva reserva -->
            <section>
                <!-- Formulario para crear una reserva -->
                <!-- La fecha de la reserva toma por defecto la fecha actual -->
                <!-- Al hacer clic en "Reservar", se realiza el proceso de creación de la reserva -->
                <!-- Si el recurso ya está ocupado, se informa del error -->
                <h3 style="color:blue">Reserva de Recurso</h3>
                <label for="fecha">Fecha Reserva</label>
                <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d') ?>" required />
                <label for="hora">Hora Reserva</label>
                <select name="hora" id="hora" required>
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                    <option value="3">Tercera</option>
                    <option value="4">Cuarta</option>
                    <option value="5">Quinta</option>
                    <option value="6">Sexta</option>
                </select>
                <button type="submit" name="reservar">Reservar</button>
            </section>

            <!-- Parte del Ejercicio 5 - Anular reserva -->
            <section>
                <!-- Formulario para anular una reserva -->
                <!-- Se utiliza el botón "Anular" para proceder con la anulación de la reserva -->
                <!-- La fecha y hora seleccionadas deben ser las de la reserva que se desea anular -->
                <!-- Al hacer clic en "Anular", el sistema decrementará el número de reservas del usuario en 1 -->
                <h3 style="color:blue">Anular Reserva</h3>
                <label for="fecha">Fecha Reserva</label>
                <input type="date" name="fecha" id="fecha" required />
                <label for="hora">Hora Reserva</label>
                <select name="hora" id="hora" required>
                    <option value="1">Primera</option>
                    <option value="2">Segunda</option>
                    <option value="3">Tercera</option>
                    <option value="4">Cuarta</option>
                    <option value="5">Quinta</option>
                    <option value="6">Sexta</option>
                </select>
                <button type="submit" name="anular">Anular</button>
            </section>

        </form>
    <?php
    }
    ?>
</body>

</html>