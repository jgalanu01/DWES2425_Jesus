<?php
require_once 'Modelo.php';

$modelo=new Modelo('agenda.dat'); //se puede poner otra extensión, txt por ejemplo
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda</title>
</head>
<body>

    <form action="#" method="post" enctype="multipart/form-data">

        <div>

            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre"  
                 value="<?php echo (isset($_POST['nombre'])?$_POST['nombre']:'')?>"/> <!-- para que se quede guardado el campo cuando se escriba -->
        </div>   
         <div>
            <label for="telf">Teléfono</label>
            <input type="text" id="telf" name="telf" pattern="[0-9]{9}"
                 value="<?php echo (isset($_POST['telf'])?$_POST['telf']:'')?>"/>
        </div> 
        <div>
            <label>Tipo</label><br/>

            <label for="amigo">Amigos</label>
            <input type="radio" id="amigo" name="tipo" value="Amigo" checked="checked"/>
            <label for="familia">Familia</label>
            <input type="radio" id="familia" name="tipo" value="Familia"
            <?php echo ((isset ($_POST['tipo']) and $_POST['tipo']=='Familia')?'checked="checked"':'')?>/>
            <label for="otros">Otros</label>
            <input type="radio" id="otros" name="tipo" value="Otros"
            <?php echo ((isset ($_POST['tipo']) and $_POST['tipo']=='Otros')?'checked="checked"':'')?>/>

        </div>
        <div>

        <label for="foto">Foto</label>
        <input type="file" id="foto" name="foto"/>
      

        </div>
        </br>
      
        <input type="submit" value="Crear" name="crear">
        
</form>
<?php

if(isset($_POST['crear'])){
    if(empty($_POST['nombre']) or empty($_POST['telf']) or empty ($_FILES['foto']['name']) or empty($_POST['tipo'])){

        echo '<h3 style="color:red;">Error, hay campos vacíos</h3>';

    }

    else{

        //Chequear si ya hay un contacto para el teléfono
        $persona = $modelo->obtenerContactos($_POST['telf']);
        //Persona tiene null si no hay contacto y un objeto contacto con todos los datos si si hay contacto

        if($persona==null){

            $id=$modelo->obtenerID();
            //El nombre del fichero será el instante de tiempo en el que se sube y el nombre original 
            //Se guardarán en la carpeta img
            $nombref='img/'.time().$_FILES['foto']['name'];
            $c=new Contacto($id,$_POST['nombre'],$_POST['telf'],$_POST['tipo'],$nombref);
    
            //Guardar el contacto en el fichero
    
            $modelo->crearContacto($c);
    
            //Guardar foto en el servidor
            $destino=$nombref;
            $origen=$_FILES['foto']['tmp_name'];
            move_uploaded_file($origen,$destino);

        }

        else{

            echo '<h3 style="color:red;">Error:Ya existe un contacto con ese tlf'
            .$persona->getNombre().'</h3>';

        }



       
    }
         

    }

      //Recuperar lo que hay en el fichero y pintarlo en una tabla

  echo '<h3>Agenda</h3>';
  echo '<table border="1"';


  echo '<tr>';
  echo '<th>Id</th>';
  echo '<th>Nombre</th>';
  echo '<th>Teléfono</th>';
  echo '<th>Tipo</th>';
  echo '<th>Foto</th>';
  echo '</tr>';
  

  //Creamos un arrray y lo rellenamos con todos los productos del fichero
  //El array va a contener objetos ticket
  $contactos = $modelo->obtenerContactos();
  foreach($contactos as $c){
      
      echo '<tr>';
      echo '<td>'.$c->getId().'</td>';
      echo '<td>'.$c->getNombre().'</td>';
      echo '<td>'.$c->getTelefono().'</td>';
      echo '<td>'.$c->getTipo().'</td>';
      echo '<td><img src="'.$c->getFoto().'" width="160px"/></td>';
      echo'</tr>';
      
  }
  echo '</table>';




  




?>
    
</body>
</html>