<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('insertarPrestamoR')}}" method="post">
        @csrf
    <label for="fecha">Fecha</label>
</br>
<input type="date" name="fecha" id="fecha" value="{{date('Y-m-d')}}">
@error('fecha')
    <p style="color:red">Rellena fecha </p>
@enderror
</br>
<label for="libro">Libro</label>
</br>
<select name="libro">
    @foreach ($libros as $l)
        <option value="{{$l->id}}">{{$l->titulo}}</option>
    @endforeach
</select>
</br> 
<label for="cliente">Cliente</label>
</br>
<input type="text" name="cliente" id="cliente" placeholder="Escribe el cliente" value="{{old('cliente')}}">
@error('cliente')
<p style="color:red">Rellena Cliente</p>
@enderror
</br>
</br>
<button type="submit" name="crear">Crear</button>
</form>
<button type="submit" name="limpiar">Limpiar</button>
    
</body>
</html>