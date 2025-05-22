<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    @if (session('mensaje'))
    <p style="color:red;">{{session('mensaje')}}</p>
    @endif

    @if (session('info'))
    <p style="color:green;">{{session('info')}}</p>
    @endif

    <h2>CRUD PILOTOS</h2>

    <form action="{{route('crearPilotoR')}}" method="post">
        @csrf
        <label for="nombre" placeholder="Teclea nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        @error('nombre')
        <p style="color:red;">Debes rellenar el campo nombre</p>
        @enderror

        <label for="nacionalidad" placeholder="Teclea nacionalidad">Nacionalidad:</label>
        <input type="text" name="nacionalidad" id="nacionalidad">
        @error('nacionalidad')
        <p style="color:red;">Debes rellenar el campo nacionalidad</p>
        @enderror

        <label for="escuderia" placeholder="Teclea escuderia">Escuderia:</label>
        <input type="text" name="escuderia" id="escuderia">
        @error('escuderia')
        <p style="color:red;">Debes rellenar el campo escuderia</p>
        @enderror

        <button type="submit" name="crear">Crear Piloto</button>

    </form>

    <h3>Pilotos</h3>

    <table border=1 width="50%">

        <thead>
            <th>Nombre</th>
            <th>Nacionalidad</th>
            <th>Escuderia</th>
            <th>Acciones</th>

        </thead>

        <tbody>
            @foreach ($pilotos as $p)
            <tr>
                <td>{{$p->nombre}}</td>
                <td>{{$p->nacionalidad}}</td>
                <td>{{$p->escuderia}}</td>
                <td><a href="{{route('modificarPilotoR',$p->id)}}">Modificar</a></td>
                <td>
                    <form action="{{route('borrarPilotoR',$p->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" name="borrar">Borrar</button>
                    </form>
                </td>


            </tr>
                
            @endforeach
           

        </tbody>

    </table>
    
</body>
</html>