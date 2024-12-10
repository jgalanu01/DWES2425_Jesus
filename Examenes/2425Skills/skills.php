<?php
require_once 'controlador.php'; // (Ejercicio 1) Incluir el controlador para manejar la lógica principal
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skills</title>
</head>

<body>
    <div>
        <!-- (Ejercicio 1) Mostrar mensaje de error si no hay conexión a la base de datos -->
        <h1 style='color:red;'><?php echo (isset($error) ? $error : '') ?></h1>
    </div>

    <!-- (Ejercicio 1) Continuar solo si hay conexión -->
    <?php if ($bd->getConexion() != null): ?>
        <form action="skills.php" method="post">

            <!-- (Ejercicio 1) Mostrar la sección Modalidad si no está seleccionada -->
            <?php if (!isset($_SESSION['mod'])): ?>
                <div>
                    <h1 style='color:blue;'>Modalidad</h1>
                    <label for="modalidad">Modalidad</label><br />

                    <!-- (Ejercicio 1) Rellenar el select con las modalidades disponibles -->
                    <select name="modalidad">
                        <?php foreach ($mod as $m): ?>
                            <option value="<?= $m->getId(); ?>"><?= $m->getModalidad(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="selModalidad">Seleccionar Modalidad</button>
                </div>
            <?php endif; ?>

            <!-- (Ejercicio 2) Mostrar la sección Alumno si hay modalidad seleccionada pero no alumno -->
            <?php if (isset($_SESSION['mod']) && !isset($_SESSION['alumno'])): ?>
                <div>
                    <h1 style='color:blue;'>Alumno</h1>
                    <label for="alumno">Alumno</label><br />

                    <!-- (Ejercicio 2) Rellenar el select con los alumnos de la modalidad seleccionada -->
                    <select name="alumno">
                        <?php
                        $alumnos = $bd->obtenerAlumnosModalidad($_SESSION['mod']->getId());
                        foreach ($alumnos as $a):
                        ?>
                            <option value="<?= $a->getId(); ?>"><?= $a->getNombre(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="selAlumno">Seleccionar Alumno</button>
                </div>
            <?php endif; ?>

            <!-- (Ejercicio 3, 4 y 5) Mostrar sección Corrección y Calificaciones si hay alumno seleccionado -->
            <?php if (isset($_SESSION['alumno'])): ?>
                <div>
                    <h1 style='color:blue;'>Corrección</h1>
                    <h2 style='color:green;'>
                        <!-- (Ejercicio 3) Mostrar información de la modalidad y del alumno -->
                        <?= $_SESSION['mod']->getModalidad() . ' - ' . $_SESSION['alumno']->getNombre() . ' - ' . $_SESSION['alumno']->getPuntuacion(); ?>
                        <?= $_SESSION['alumno']->getFinalizado() ? '(Finalizado)' : '(Provisional)'; ?>
                    </h2>
                    <!-- (Ejercicio 3) Botones para cambiar alumno o modalidad -->
                    <button type="submit" name="cambiarM">Cambiar Modalidad</button>
                    <button type="submit" name="cambiarA">Cambiar Alumno</button>

                    <!-- (Ejercicio 4) Formulario para calificar pruebas -->
                    <table>
                        <tr>
                            <td><label for="prueba">Prueba</label><br /></td>
                            <td><label for="puntos">Puntos</label><br /></td>
                            <td><label for="comentario">Comentario</label></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <select id="prueba" name="prueba">
                                    <?php
                                    $pruebas = $bd->obtenerPruebasModalidad($_SESSION['mod']->getId());
                                    foreach ($pruebas as $p):
                                    ?>
                                        <option value="<?= $p->getId(); ?>">
                                            <?= $p->getDescripcion() . ' - ' . $p->getPuntuacion(); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            <td><input id="puntos" type="number" name="puntos" value="1" /></td>
                            <td><input id="comentario" type="text" name="comentario" placeholder="Comentario" /></td>
                            <td><button type="submit" name="guardar">Guardar</button></td>
                        </tr>
                    </table>
                </div>

                <!-- (Ejercicio 4) Mostrar calificaciones del alumno -->
                <div>
                    <h1 style='color:blue;'>Calificaciones del alumno</h1>
                    <table border="1" rules="all" width="50%">
                        <tr>
                            <td><b>Prueba</b></td>
                            <td><b>Puntos Asignados</b></td>
                            <td><b>Puntos Obtenidos</b></td>
                            <td><b>Comentario</b></td>
                        </tr>
                        <?php
                        $calificaciones = $bd->obtenerCalificaciones($_SESSION['alumno']->getId());
                        foreach ($calificaciones as $c):
                        ?>
                            <tr>
                                <td><?= $c->getPrueba()->getDescripcion(); ?></td>
                                <td><?= $c->getPrueba()->getPuntuacion(); ?></td>
                                <td><?= $c->getPuntos(); ?></td>
                                <td><?= $c->getComentario(); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                    <!-- (Ejercicio 5) Botón para finalizar corrección -->
                    <button type="submit" name="finalizar">Finalizar Corrección</button>
                </div>
            <?php endif; ?>
        </form>
    <?php endif; ?>

    <!-- (Ejercicio 6) Mostrar los ganadores -->
    <div>
        <h1 style='color:blue;'>Ganadores</h1>
        <table border="1" rules="all" width="50%">
            <tr>
                <td><b>Modalidad</b></td>
                <td><b>Nombre</b></td>
                <td><b>Puntuación</b></td>
            </tr>
            <?php
            $ganadores = $bd->obtenerGanadores();
            foreach ($ganadores as $g):
            ?>
                <tr>
                    <td><?= $g[0]; ?></td>
                    <td><?= $g[1]; ?></td>
                    <td><?= $g[2]; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>

</html>