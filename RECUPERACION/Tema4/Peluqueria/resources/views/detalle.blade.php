<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <h3>Fecha:{{$cita->fecha}} /Hora:{{$cita->hora}} /Cliente:{{$cita->cliente}} </h3>
</br>
<a href="{{route('inicioR')}}">Volver</a>


<form action="{{route('aniadirR',$cita->id)}}" method="post">
    @csrf
    <select name="servicio" id="servicio">
        @foreach ($servicio as $s)
        <option value={{$s->id}}>{{$s->descripcion}}</option>
            
        @endforeach

    </select>
    <button type="submit">Añadir</button> 

</form>

<h3>Servicios de la cita</h3>

<form action="{{route('finalizarCitaR',$cita->id)}}" method="post">
    @method('PUT')
@csrf
<button type="submit" name="finalizar">Finalizar cita</button>
</form>

<table border="1" width="50%">
    <tr>
        <td>Id</td>
        <td>Descripción</td>
        <td>Importe</td>
    </tr>
    @foreach($cita->detalleCitas() as $d)
    <tr>
        <td>{{$d->id}}</td>
        <td>{{$d->servicio->descripcion}}</td>
        <td>{{$d->precio}}</td>
    </tr>
    @endforeach
</table>

</body>
</html>