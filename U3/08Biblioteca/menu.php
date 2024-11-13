<?php
if (basename($_SERVER['PHP_SELF']) == 'Menu.php') {
    header('location:prestamos.php');
}
?>

<a href="prestamos.php">Préstamos</a>
<a href="libros.php">Libros</a>
<?php
if ($_SESSION['usuario']->getTipo() == 'A') {
?>

    <a href="socios.php">Usuarios</a>
<?php

}

?>
<form action="controlador.php" method="post">
    <span><?php echo $_SESSION['usuario']->getId() ?></span>
    <button type="submit" name="cerrar">Salir</button>

</form>