<?php
require_once 'Modelo.php';
session_start();
if (isset($_SESSION['usuario'])) {
    //Redirigimos si ya estamos logueados
    header('location:prestamos.php');
}
if (isset($_POST['entrar'])) {
    $bd = new Modelo();
    if ($bd->getConexion() == null) {
        $error = 'Error, no se puede conectar con la BD';
    } else {

        //Comprobar usuario y ps y si los datos son correctos, guardamos el usuario en una sesión y redirigimos a la pagina préstamos.php

        $us = $bd->loguear($_POST['usuario'], $_POST['ps']);
        if ($us != null) {
            //Almacenamos en la sesión
            $_SESSION['usuario'] = $us;
            //Redirigimos 
            header('location:prestamos.php');

            $error = 'Datos correctos';
        } else {
            $error = 'Error, datos incorrectos';
        }
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container">

        <p class="display-2">Biblioteca - Login</p>
        <form action="" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Usuario</label>
                <input type="text" name="usuario" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="ps" class="form-control" id="exampleInputPassword1">
            </div>

            <button type="submit" class="btn btn-primary" name="entrar">Entrar</button>
        </form>

        <?php
        if (isset($error)) {
            echo '<div class="text-danger">' . $error . '</div>';
        }

        ?>
    </div>
</body>

</html>