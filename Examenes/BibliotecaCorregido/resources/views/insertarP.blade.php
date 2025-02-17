<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Crear prestamo</title>
</head>
<body>
    <form action="{{route('crearP')}}" method="post">
        @csrf
        <input type="date" name="fecha" value="{{date('Y-m-d')}}"/>
        @error('fecha')
            <p style="color:red;">Rellena Fecha</p>
        @enderror
        <select name="libro" id="libro">
            @foreach ($libros as $l)
                <option value="{{$l->id}}">{{$l->titulo}}</option>
            @endforeach
        </select>
        @error('libro')
        <p style="color:red;">Escoge libro</p>
        @enderror
        <input type="text" name="cliente" value="{{ old('cliente') }}" placeholder="Cliente"/>
        @error('cliente')
        <p style="color:red;">Rellena Cliente</p>
        @enderror
        
        <button type="submit">Crear prestamo</button>

        @if (session('mensaje'))
        <p style="color:red;">{{session('mensaje')}}</p>
        @endif
    </form>
</body>
</html>