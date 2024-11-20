<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>

    <form action="{{route('loguear')}}" method="post"><!--Esta ruta entra por post al estar en el form-->
        @csrf
        Email
        <input type="email" name="email"/>
        Contraseña
        <input type="password" name="ps"/>
        <button type="submit" name="login">Login</button>
        <a href="{{route('vistaRegistro')}}">Registrarse</a> <!--Esta ruta entra por get al ser un enlace-->
    </form>
    
</body>
</html>