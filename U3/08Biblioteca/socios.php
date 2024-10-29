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

        ?>

            <form action="" method="post">
                <div>
                    <label for="dni">DNI</label>
                    <input type="text" name="dni" id="dni" />

                </div>


                <div>
                    <label for="tipo">Tipo</label>
                    <select name="tipo" id="tipo">
                        <option value="A">Administrador</option>
                        <option value="S">Socio</option>
                    </select>
                </div>

                <div>
                    <label>Accion</label><br>
                </div>

                <button type="submit" name="sCrear">Crear</button>
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
                        <th>Tipo</th>
                        <th>IdSocio</th>
                        <th>Nombre</th>
                        <th>Fecha Sanción</th>
                        <th>Email</th>
                        <?php if ($_SESSION['usuario']->getTipo() == 'A') { ?>
                            <th>Acciones</th>
                        <?php } ?>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </form>
    </div>

</body>

</html>