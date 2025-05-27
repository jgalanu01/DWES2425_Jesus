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

<form action="" method="post">
  <h2>Pilotos de F1</h2>
  <h2 style="color:red"><?php echo (isset($mensaje) ? $mensaje : '') ?></h2>
    <label for="piloto">Piloto</label>
    <select name="piloto" id="piloto">
      <?php
      $pilotos = $bd->obtenerPilotos();
      foreach ($pilotos as $p) {
        echo '<option value="' .$p->getId() . '">' . $p->getNombre()  . '</option>';
      }
      ?>
    </select>

      <button type="submit" name="carrera">Carrera</button>

      </form>
</body>
</html>