<?php
require_once 'controlador.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mis Notas</title>
</head>
<body>
  <form action="" method="post">
    <h1>Mis notas</h1>
    <h2 style="color:red"><?php echo (isset($mensaje) ? $mensaje : '') ?></h2>

    <!-- Mostrar última nota registrada -->
    <?php
    if (isset($_SESSION['ultimaNota'])) {
      echo '<p><strong>Última nota registrada:</strong> '
        . $_SESSION['ultimaNota']->getNota() . ' - '
        . $_SESSION['ultimaNota']->getDescripcion() . '</p>';
    } else {
      echo '<p><strong>No se ha registrado ninguna nota en esta sesión.</strong></p>';
    }
    ?>

    <label for="asignatura">Asignatura</label>
    <select name="asignatura" id="asignatura">
      <?php
      $asignaturas = $bd->obtenerAsignaturas();
      foreach ($asignaturas as $a) {
        echo '<option value="' . $a->getId() . '">' . $a->getNombre() . '</option>';
      }
      ?>
    </select>

    <label for="fecha">Fecha</label>
    <input type="date" name="fecha" value="<?php echo (!empty($_POST['fecha']) ? $_POST['fecha'] : date('Y-m-d')) ?>">

    <label for="descripcion">Descripción</label>
    <input type="text" name="descripcion">

    <label for="notas">Nota</label>
    <input type="number" name="notas" step="0.01">

    <button type="submit" name="crear">Crear</button>

    <table border="1">
      <thead>
        <tr>
          <th>ID</th>
          <th>Asignatura</th>
          <th>Fecha</th>
          <th>Descripción</th>
          <th>Nota</th>
          <th>Anulada</th>
          <th colspan="2">Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $notas = $bd->obtenerNotas();
        foreach ($notas as $n) {
          echo '<tr>
            <td>' . $n->getId() . '</td>
            <td>' . $n->getAsignatura()->getNombre() . '</td>
            <td>' . $n->getFecha() . '</td>
            <td>' . $n->getDescripcion() . '</td>
            <td>' . $n->getNota() . '</td>
            <td>' . ($n->getAnulada() ? 'Sí' : 'No') . '</td>
            <td><button type="submit" name="anular" value="' . $n->getId() . '">Anular</button></td>
            <td><button type="submit" name="borrar" value="' . $n->getId() . '">Borrar</button></td>
          </tr>';
        }
        ?>
      </tbody>
    </table>
  </form>
</body>
</html>
