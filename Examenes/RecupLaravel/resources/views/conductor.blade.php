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

    <div class="container">
    <h2>Identificación del conductor</h2>


    <form action="{{route('comprobarD')}}" method="post">
    <h3>Conductor</h3>
    <select name="conductor" id="conductor">
        @foreach($conductor as $c)
        <option value="{{c->id}}">{{c->dni}}</option>
        @endforeach
    </select>
    <br>
    <button type="submit">Ir a servicio</button>
        @csrf
        <input type="date" name="fecha" value="{{date ("Y-m-d")}}"/>
        @error('fecha')
            <p>Rellena Fecha</p>
        @enderror
    

    </div>
    
</body>
</html>