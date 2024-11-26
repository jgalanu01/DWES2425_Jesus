<?php
// Inicializar array 
$eventos = [];

// Recuperar los eventos desde la cookie
if (isset($_COOKIE['eventos'])) {
    $eventos = unserialize($_COOKIE['eventos']);
}

// Agregar un evento
if (isset($_POST['agregar'])) {
    $eventos[] = ['fecha' => $_POST['fecha'], 'hora' => $_POST['hora'], 'asunto' => $_POST['asunto']];
    setcookie('eventos', serialize($eventos), time() + 3600);
    header('location:07Ejercicio4.php'); // Recargar

}

// Eliminar un evento
if (isset($_POST['eliminar'])) {
    unset($eventos[$_POST['indice']]);
    $eventos = array_values($eventos); // Reindexar el array
    setcookie('eventos', serialize($eventos), time() + 3600);
    header('location:07Ejercicio4.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eventos</title>
</head>

<body>
    <h2>Calendario de eventos</h2>
    <ul>
        <?php foreach ($eventos as $indice => $evento): ?>
            <li>
                <strong>Fecha:</strong> <?php echo $evento['fecha']; ?>,
                <strong>Hora:</strong> <?php echo $evento['hora']; ?>,
                <strong>Asunto:</strong> <?php echo $evento['asunto']; ?>
                <form action="" method="post">
                    <input type="hidden" name="indice" value="<?php echo $indice; ?>">
                    <input type="submit" name="eliminar" value="Eliminar">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>

    <h3>Agregar nuevo evento</h3>
    <form action="" method="post">
        <input type="date" name="fecha" required>
        <input type="time" name="hora" required>
        <input type="text" name="asunto" required>
        <input type="submit" name="agregar" value="Agregar Evento">
    </form>
</body>

</html>