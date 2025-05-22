<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if(session('mensaje'))
    <h2 style="color :red;">{{session('mensaje')}}</h2>
    @endif



    <h3>Nuevo Juego platinado</h3>
    <a href="{{route('rInicio')}}">Volver</a>

    <form action="{{route('crearJuegoR')}}" method="post">
        @csrf

    <label for="nombre">Nombre del juego</label>
    <input type="text" name="nombre" id="nombre" value="{{old('nombre')}}">
</br>
    <label for="plataforma">Plataforma</label>
    <input type="text" name="plataforma" id="plataforma" value="{{old('plataforma')}}">

</br>

<label for="precio">Precio</label>
<input type="number" name="precio" id="precio" value="{{old('precio')}}">

</br>

<label for="stock">Stock</label>
<input type="number" name="stock" id="stock" value="{{old('stock')}}">


<button type="submit" name="crear">Crear</button>

</form>


    
</body>
</html>