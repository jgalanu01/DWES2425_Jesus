<?php

require_once 'Modelo.php';

$modelo=new Modelo();

//Cargar asignaturas en un array
$asigs=$modelo->obtenerAsignaturas();



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notas</title>
</head>
<body>

<h1>Notas de exámenes y tareas 2º DAW</h1>
<form action="#" method="post">

<div>
    <label for="asig">Asignaturas</label><br/>
    <select name="asig" id="asig">
<!-- Hacer un option para cada asignatura-->
 <?php

 foreach ($asigs as $a){
    echo '<option>'.$a.'</option>';

 }
 ?>

    </select>
    </div>
    <div>
    <label for="fecha">Fecha</label><br/>
    <input type="date" name="fecha" id="fecha" value="<?php echo date ('Y-m-d');?>"/>
    </div>

    <div>
        <label for="desc">Descripción</label><br/>
        <input type="text" name="desc"  id="desc" placeholder="Examen tema 1"/>

    </div>
    <div>

    <label>Tipo</label>
    <input type="radio" name="tipo" id="ex" value="Examen" checked="checked"/>
    <label for="ex">Examen</label>
    <input type="radio" name="tipo" id="ta" value="Tarea"/>
    <label for="ta">Tarea</label>
    </div>

    <div>
        <label for="nota">Nota</label><br/>
        <input type="number" name="nota" id="nota" placeholder="Nota"/>

        
    </div>
    <input type="submit" value="Crer nota" name="crear">


<?php

if(isset($_POST['crear'])){

    if(empty($_POST['asig']) or empty($_POST['fecha']) or empty($_POST['desc']) or empty($_POST['tipo']) or empty($_POST['nota'])){

        echo '<h3 style="color:red;">Error, hay campos vacíos</h3>';

    }

    else{

        $nota=new Nota($_POST['asig'],$_POST['fecha'],$_POST['tipo'],$_POST['desc'],$_POST['nota']);
        $modelo->crearNota($nota);

        //Recuperar lo que hay en el fichero 

        echo'<h3>Notas</h3>';
        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Asignaturas</th>';
        echo '<th>Fecha</th>';
        echo '<th>Tipo</th>';
        echo '<th>Descripción</th>';
        echo '<th>Nota</th>';
        echo '</tr>';


        //Obtener notas

        $notas=$modelo->obtenerNotas();
        foreach($notas as $n){
            echo '<tr>';
            echo '<td>' . $n->getAsi(). '</td>';
            echo '<td>' . $n->getFecha(). '</td>';
            echo '<td>' . $n->getTipo(). '</td>';
            echo '<td>' . $n->getDesc(). '</td>';
            echo '<td>' . $n->getNota(). '</td>';
            echo '</tr>';
        }

echo '</table>';
    }
}


?>

</form>
    

    
</body>
</html>