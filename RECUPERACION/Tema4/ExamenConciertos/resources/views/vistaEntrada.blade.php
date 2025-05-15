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

    @if(session('info'))
    <h2 style="color :green;">{{session('info')}}</h2>
    @endif


    <form action="{{route('rBorrar',$concierto->id)}}" method="post">
        @method('DELETE')
        @csrf
       
    <h2>Concierto:{{$concierto->titulo}} <button type="submit" name="borrar" id="borrar">Borrar</button></h2>    <!--$concierto la variable del compact del controlador -->
    </form>
    <h2>Aforo:{{$concierto->aforo}}</h2>
    <h2>Precio entrada:{{$concierto->precioEntrada}}</h2>
    <h2><a href="{{route('rInicio')}}">Inicio</a></h2>
   
    <form action="{{route('rVender',$concierto->id)}}" method="post"> <!-- En la ruta tengo puesto que hay que pasarle parámetro, y le paso el del compact-->
        @csrf
      

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value={{old('email')}}> <!-- Old para recordar el valor !-->

    @error('email')
    <h2 style="color :red;">Debes rellenar el email</h2>
    @enderror

    <label for="numEntradas">Nº de Entradas</label>
    <input type="number" name="numEntradas" id="numEntradas" value={{old('numEntradas')}}>

    @error('numEntradas')
    <h2 style="color :red;">Debes rellenar el número de entradas</h2>
    @enderror

    <button type="submit" name="registrarV" id="registrarV">Registrar entradas</button>
    </form>

    <div style="background-color: antiquewhite; width: 800px;">
    <h2>Entradas Vendidas</h2>
    <table border="1">

        <tr>
            <td>Id</td>
            <td>Fecha</td>
            <td>Email</td>
            <td>Aforo</td>


    @foreach($concierto->entradas() as $e) <!-- Llamamos al has many para pintar las entradas!-->

    <tr>
        <td>{{$e->concierto->id}}</td>
        <td>{{$e->concierto->fecha}}</td>
        <td>{{$e->email}}</td>
        <td>{{$e->concierto->aforo}}</td>
    </tr>
    @endforeach
</table>
        

    
    
</body>
</html>