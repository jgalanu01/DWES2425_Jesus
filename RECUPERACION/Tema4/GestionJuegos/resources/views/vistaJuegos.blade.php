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
    <p style="color:red">{{ session('mensaje') }}</p>
@endif
    <h2>Videojuegos</h2>

    <a href={{route('nuevoJuegoR')}}>+ Nuevo Videojuego</a>

    <table border=1 width="50%">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Plataforma</td>
                <td>Precio</td>
                <td>Stock</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($juegos as $j)

            <tr>
                <td>{{$j->id}}</td>
                <td>{{$j->nombre}}</td>
                <td>{{$j->plataforma}}</td>
                <td>{{$j->precio}}</td>
                <td>{{$j->stock}}</td>
                <td>
                <a href="{{route('editarJuegoR',$j->id)}}">Editar</a>
                <form action="{{route('borrarJuegoR',$j->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Borrar</button>
                </form>
            </td>
            </tr>
                
            @endforeach
        </tbody>
       

    </table>

   


</body>
</html>