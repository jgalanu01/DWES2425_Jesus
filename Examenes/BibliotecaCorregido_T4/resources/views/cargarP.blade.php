<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>cargar prestamo</title>
</head>
<body>
    <form action="{{route('modificarP',$prestamo->id)}}" method="post">
        @csrf
        @method('PUT')
        <input type="number" name="id" value="{{$prestamo->id}}" readonly>
        <input type="date" name="fecha" value="{{$prestamo->fecha}}"/>
        <input type="text" name="libro" value="{{$prestamo->libro->titulo}}" readonly>
        <input type="text" name="cliente" value="{{$prestamo->nombreCliente}}" placeholder="Cliente"/>
        @if ($prestamo->fechaDevolucion==null)
        <input type="date" name="fechaD" value="{{date('Y-m-d')}}"/> 
        @else
        <input type="date" name="fechaD" value="{{$prestamo->fechaDevolucion}}"/>
        @endif
        <button type="submit">Modificar</button>
        </form>
        <form action="{{route('verP')}}" method="get">
            @csrf
            <button type="submit">Cancelar</button>
        </form
        @if (session('mensaje'))
        <p style="color:red;">{{session('mensaje')}}</p>
        @endif
</body>
</html>