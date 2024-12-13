<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Selecciona un concierto</h1>
    <form action="{{route('verEntradas',$concierto->id)}}" method="get">
       @csrf 
       <select name="conciertos" id="conciertos">
        @foreach($conciertos as $c)
        <option value="{{$c->id}}">{{$c->titulo}}</option>
        @endforeach
       </select>
    </button type="submit">Entradas</button>
    </form>

    <h2>Listado de Conciertos</h2>
    <table border="1" width="50%">
        <tr>
            <td>Id</td>
            <td>Título</td>
            <td>Fecha</td>
            <td>Aforo</td>
            <td>Precio</td>

        </tr>
        @foreach($conciertos->concierto() as $co)
        <tr>
            <td>{{$co->id}}</td>
            <td>{{$co->concierto->titulo}}</td>
            <td>{{$co->fecha}}</td>
            <td>{{$co->aforo}}</td>
            <td>{{$co->precio}}</td>
        </tr>

        @endforeach
        <table>

            

    
</body>
</html>