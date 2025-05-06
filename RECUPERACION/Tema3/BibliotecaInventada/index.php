<?php

require_once 'controlador.php';

if($bd->getConexion()==null){
    echo ('No se ha establecido conexión '.$mensaje);
}else{






?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Libros</title>
</head>
<body>
    <!-- Sección de mensajes -->
    <section>
        <h3 style="color:red"><?php echo (isset($mensaje) ? $mensaje :'')?></h3>
    </section>


    <?php if(!isset($_SESSION['autor'])){

?>
    <!-- Sección de login (solo se muestra si NO hay sesión) -->
    <section>
        <h2>Login</h2>
        <form method="POST">
            <label for="idAutor">ID Autor</label><br>
            <input type="text" name="idAutor"><br>
            <label for="ps">Contraseña</label><br>
            <input type="password" name="ps"><br><br>
            <input type="submit" name="acceder" value="Entrar">
        </form>
    </section>

    <?php
    }else{

?>



    <!-- Sección que solo se muestra si hay un autor logueado -->
    <section>
        <h2>Información del autor</h2>
        <p>ID:<?php echo $_SESSION['autor']->getIdAutor() ?></p>
        <p>Nombre:<?php echo $_SESSION['autor']->getNombre()?></p>
        <form method="POST">
            <input type="submit" name="salir" value="Cerrar sesión">
        </form>
    </section>

    <section>
        <h2>Libros del autor</h2>
        <!-- Tabla de libros -->
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Género</th>
                <th>Año</th>
                <th>Acciones</th>
            </tr>

            <?php if(isset($libros)){
                foreach($libros as $l){ ?>
                <tr>
                    <td><?php echo $l->getId();?></td>
                    <td><?php echo $l->getTitulo();?></td>
                    <td><?php echo $l->getGenero();?></td>
                    <td><?php echo $l->getAnio();?></td>
                </tr>

            <?php
                }
                

            
            } 
            
            ?>
            <!-- Aquí se mostrarán los libros -->
        </table>
    </section>

    <!-- Insertar libro -->
    <section>
        <h2>Nuevo libro</h2>
        <form method="POST">
            <label for="titulo">Título</label><br>
            <input type="text" name="titulo"><br>
            <label for="genero">Género</label><br>
            <input type="text" name="genero"><br>
            <label for="anio">Año</label><br>
            <input type="number" name="anio"><br><br>
            <input type="submit" name="insertar" value="Insertar libro">
        </form>
    </section>

    <!-- Editar libro (se rellenará desde el controlador si se selecciona uno) -->
    <section>
        <h2>Editar libro</h2>
        <form method="POST">
            <input type="hidden" name="idEditar" value="[ID libro a editar]">
            <label for="titulo">Título</label><br>
            <input type="text" name="titulo"><br>
            <label for="genero">Género</label><br>
            <input type="text" name="genero"><br>
            <label for="anio">Año</label><br>
            <input type="number" name="anio"><br><br>
            <input type="submit" name="editar" value="Guardar cambios">
        </form>
    </section>

    <?php

    }

    ?>
</body>
</html>

<?php

}

?>
