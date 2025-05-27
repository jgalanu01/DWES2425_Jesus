<?php

require_once 'Controlador.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h2 style="color:red"><?php echo (isset($mensaje) ? $mensaje : '') ?></h2>
<h2 style="color:green"><?php echo (isset($info) ? $info : '') ?></h2>
    
<h2>Nombre:<?php echo $_SESSION['piloto']->getNombre(); ?></h2>
<h2>Escudería:<?php echo $_SESSION['piloto']->getEscuderia(); ?></h2>

<form action="" method="post">
    <label for="tiempo"></label>
        <input type="number" name="tiempo" id="tiempo">

        <button type="submit" name="crear">Crear</button>
        <button type="submit" name="salir">Salir</button>

        <table border=1 width="50%">

        <h2>Vueltas</h2>

        <tr>
            <td>Id</td>
            <td>Nombre del piloto</td>
            <td>Duración</td>
            <td>Anulada</td>
            <td colspan="2">Acciones</td>
        </tr>

        <?php 
        $mostrarV=$bd->obtenerVueltas($_SESSION['piloto']->getId());
        
        foreach ($mostrarV as $v) {
    echo '<tr>
            <td>' . $v->getId() . '</td>
            <td>' . $v->getPiloto_id()->getNombre() . '</td>
            <td>' . $v->getTiempo() . '</td>
            <td>' .($v->getAnulada() ? 'Sí' : 'No') . '</td>
            <td><button type="submit" name="anular" value="' . $v->getId() . '">Anular</button></td>
            <td><button type="submit" name="borrar" value="' . $v->getId() . '">Borrar</button></td>

             
        </tr>';
          }
          ?>
        

        </table>
    
</form>
</body>
</html>