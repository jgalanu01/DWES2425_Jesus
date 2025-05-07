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

    <form action="" method="post">

    <section>

    <?php echo (isset($mensaje) ? $mensaje : ' ')   ?>
        
    </section>

        <label for="asignatura">Asignatura</label>
        <br/>
        <select name="asignatura">
            <?php

           foreach($asignaturas as $a){
            ?>
           <option <?php echo $a->getId()?>><?php echo $a->getNombre()?></option>
            

        <?php
       }

       ?>
         

            


            
        
        </select>
        <br>

        <label for="fecha">Fecha</label>
        <br>
        <input type="date" name="fecha" id="fecha" value="<?php echo (isset($_POST['fecha'])? $_POST['fecha']: date('Y-m-d'))?>">
        <br>

        <label for="descripcion">Descripción de la asignatura</label>
        <br>
        <input type="text" name="descripcion" id="descripcion">
        <br>

        <label for="nota">Nota de la asignatura</label>
        <br>
        <input type="number" name="nota" id="nota" step="0.1">
        <br>

        <button type="submit" name="Crear" id="Crear">Crear

        </button>





    </form>
    
</body>
</html>