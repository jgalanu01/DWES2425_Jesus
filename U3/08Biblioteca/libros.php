<?php
require_once 'controlador.php';
require_once 'Menu.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Libros</title>
</head>

<body>

    <!-- Menú de Navegación -->
    <?php
    include 'Menu.php';
    ?>

    <div>
        <!-- Mensajes de éxito o error -->
        <?php
        if (isset($mensaje)) {
            echo '<div class="alert alert-success" role="alert">' . $mensaje . '</div>';
        }

        if (isset($error)) {
            echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
        }
        ?>
    </div>

    <div>
        <!-- Área de creación de libros (visible solo para el admin) -->
        <?php
        if ($_SESSION['usuario']->getTipo() == 'A') {
        ?>
            <form action="" method="post">
                <label for="titulo">Título</label>
                <input type="text" name="titulo" id="titulo" required>

                <label for="autor">Autor</label>
                <input type="text" name="autor" id="autor" required>

                <label for="ejemplares">Ejemplares</label>
                <input type="number" name="ejemplares" id="ejemplares" min="1" required>

                <button type="submit" name="crearLibro">Crear Libro</button>
            </form>
        <?php
        }
        ?>
    </div>

    <div>
        <br />
        <!-- Mostrar lista de libros -->
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Ejemplares</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $libros = $bd->obtenerLibros();
                foreach ($libros as $libro) {
                    echo '<tr>';
                    echo '<td>' . $libro->getId() . '</td>';
                    echo '<td>' . $libro->getTitulo() . '</td>';
                    echo '<td>' . $libro->getAutor() . '</td>';
                    echo '<td>' . $libro->getEjemplares() . '</td>';
                    echo '<td>';
                    echo '<button type="submit" name="modificarLibro" value="' . $libro->getId() . '">Modificar</button> ';
                    echo '<button type="submit" name="borrarLibro" value="' . $libro->getId() . '">Borrar</button>';
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>