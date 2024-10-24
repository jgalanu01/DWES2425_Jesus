<?php

require_once 'controlador.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    require_once 'Menu.php';
    ?>

    <div>

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

        <!-- ÁREA DE INSERT (SOLO ADMIN) -->
        <?php

        if ($_SESSION['usuario']->getTIpo() == 'A') {

            //Obtenemos los socios
            $socios = $bd->obtenerSocios();
            //Obtenemos libros
            $libros = $bd->obtenerLibros();


        ?>

            <form action="" method="post">

                <label for="socio">socio</label>
                <select name="socio" id="socio">
                    <?php
                    foreach ($socios as $s) {
                        echo '<option value="' . $s->getId() . '">' . $s->getNombre() . '-' . $s->getUs() . '</option>';
                    }
                    ?>


                </select>

                <label for="libro">Libro</label>
                <select name="libro" id="libro">
                    <?php
                    foreach ($libros as $l) {
                        echo '<option value="' . $l->getId() . '">' . $l->getTitulo() . '-' . $l->getEjemplares() . '</option>';
                    }
                    ?>


                </select>
                <button type="submit" name="pCrear">Crear Préstamo</button>
            </form>
        <?php
        }
        ?>
    </div>
    <div>
        <br />
        <!--Mostrar préstamos-->
        <form action="" method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Socio</th>
                        <th>Libro</th>
                        <th>Fecha Préstamos</th>
                        <th>Fecha Devolución</th>
                        <th>Fecha Real Devolución</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $prestamos = $bd->obtenerPrestamos();
                    foreach ($prestamos as $p) {
                        echo '<tr>';
                        echo '<td>' . $p->getId() . '</td>';
                        echo '<td>' . $p->getSocio()->getNombre() . '-' . $p->getSocio()->getUs() . '</td>';
                        echo '<td>' . $p->getLibro()->getTitulo() . '-' . $p->getLibro()->getAutor() . '</td>';
                        echo '<td>' . date('d/m/Y', strtotime($p->getFechaP())) . '</td>';
                        echo '<td>' . date('d/m/Y', strtotime($p->getFechaD())) . '</td>';
                        echo '<td>' . ($p->getFechaRD() == null ? '' : date('d/m/Y', strtotime($p->getFechaRD()))) . '</td>';
                        echo '<td>' . ($p->getFechaRD() == null ?
                            '<button type="submit" name="pDevolver" value="'.$p->getId().'">Devolver</button>':'');
                        echo '</td>';
                        echo '</tr>';
                    }

                    ?>
                </tbody>
            </table>
        </form>
    </div>

</body>

</html>