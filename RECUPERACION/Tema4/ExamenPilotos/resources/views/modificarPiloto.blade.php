<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if (session('info'))
    <p style="color:green;">{{session('info')}}</p>
    @endif

    @if (session('mensaje'))
    <p style="color:red;">{{session('mensaje')}}</p>
    @endif
    <h2>MODIFICAR PILOTO</h2>

    <a href="{{route('inicioR')}}">Volver</a>
    
    <form action="{{route('actualizarPilotoR',$piloto->id)}}" method="post">
        @csrf
        @method('PUT')
        <label for="nombre" placeholder="Teclea nombre">Nombre:</label>
    </br>
        <input type="text" name="nombre" id="nombre" value="{{$piloto->nombre}}">
        @error('nombre')
        <p style="color:red;">Debes rellenar el campo nombre</p>
        @enderror
    </br>
        <label for="nacionalidad" placeholder="Teclea nacionalidad">Nacionalidad:</label>
    </br>
        <input type="text" name="nacionalidad" id="nacionalidad" value="{{$piloto->nacionalidad}}">
        @error('nacionalidad')
        <p style="color:red;">Debes rellenar el campo nacionalidad</p>
        @enderror
    </br>
        <label for="escuderia" placeholder="Teclea escuderia">Escuderia:</label>
    </br>
        <input type="text" name="escuderia" id="escuderia"  value="{{$piloto->escuderia}}">
        @error('escuderia')
        <p style="color:red;">Debes rellenar el campo escuderia</p>
        @enderror
    </br>
    
        <button type="submit" name="guardar">Guardar Piloto</button>

    </form>

    
</body>
</html>