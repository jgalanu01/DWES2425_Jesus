<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <h2>Concierto:{{$concierto->titulo}}</h2>    <!--$concierto la variable del compact del controlador -->
    <h2>Aforo:{{$concierto->aforo}}</h2>
    <h2>Precio entrada:{{$concierto->precioEntrada}}</h2>
    <h2><a href="{{route('rInicio')}}">Inicio</a></h2>
    <form action="{{route('rVender',$concierto->id)}}" method="post"> <!-- En la ruta tengo puesto que hay que pasarle parámetro, y le paso el del comapact-->

    <label for="email">Email</label>
    <input type="email" name="email" id="email">

    <label for="numEntradas">Nº de Entradas</label>
    <input type="number" name="numEntradas" id="numEntradas">

    <button type="submit" name="registrarV" id="registrarV">Registrar entradas</button>
    
    
</body>
</html>