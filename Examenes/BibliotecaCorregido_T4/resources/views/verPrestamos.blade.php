<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestamos</title>
</head>
<body>
<table border="1" width="50%">
    @if (session('mensaje'))
    <p style="color:red;">{{session('mensaje')}}</p>
    @endif
        <tr>
            <td>Id</td>
            <td>Fecha</td>
            <td>Titulo</td>
            <td>Cliente</td>
            <td>Fecha D</td>
            <td>Accion</td>
        </tr>
        {{-- El nombre de la variable depende de como se llame en el controlador y en la funcion que cargue esta view --}}
        @foreach ($prestamos as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->fecha}}</td>
            <td>{{$p->libro->titulo}}</td>
            <td>{{$p->nombreCliente}}</td>
            <td>{{$p->fechaDevolucion}}</td>
            <td>
                <form action="{{route('cargarP',$p->id)}}" method="get">
                    @csrf
                    <button type="submit" name="modificar">Modificar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
    <form action="{{route('insertarP')}}" method="get">
        @csrf
        <button type="submit" name="crear">Crear</button>
    </form>
    
</body>
</html>