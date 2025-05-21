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


    <h2>Citas</h2>
    <h3>Crear Cita</h3>

    <form action="{{route('crearCitaR')}}" method="post">
        @csrf
    <input type="date" name="fecha" value="{{date('Y-m-d')}}">
    @error('fecha')
    <p style="color:red;">Rellena la fecha</p> 
    @enderror
    <input type="time" name="hora" value="{{date('H:i')}}">
    @error('hora')
    <p style="color:red;">Rellena la hora</p> 
        
    @enderror
    <input type="text" name="cliente" placeholder="Cliente">
    @error('cliente')
        
    @enderror
    <button type="submit" name="crear">Crear Cita</button>

    </form>
</br>
    <h2>Citas</h2>

    <table border=1 width="50%">

        <tr>

            <td>Id</td>
            <td>Fecha</td>
            <td>Hora</td>
            <td>Cliente</td>
            <td>Precio</td>
            <td>Acciones</td>

        </tr>

        @foreach ($cita as $c)

        <tr>
            <td>{{$c->id}}</td>
            <td>{{$c->fecha}}</td>
            <td>{{$c->hora}}</td>
            <td>{{$c->cliente}}</td>
            <td>{{$c->total}}</td>

        </tr>
            
        @endforeach
       

    
</body>
</html>