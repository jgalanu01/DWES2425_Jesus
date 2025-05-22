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
    <h1>PRÉSTAMOS</h1>

        <a href="{{route('crearPrestamoR')}}">+ Nuevo</a>
    <table border="1" with="50">
        <tr>
            <td>Id</td>
            <td>Fecha de préstamo</td>
            <td>Titulo del libro</td>
            <td>Cliente</td>
            <td>Fecha Devolución</td>
            <td>Accion</td>
        </tr>
        @foreach ($prestamos as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->fecha}}</td>
            <td>{{$p->libro_id}}</td>
            <td>{{$p->nombreCliente}}</td>
            <td>{{$p->fechaDevolucion}}</td>
            <td>
                <a href="{{route('',$p->id)}}">Modificar</a>
            </td>
        </tr>
        @endforeach
       

        </tr>
    </table>
</body>
</html>