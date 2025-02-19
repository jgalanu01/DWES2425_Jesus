<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('identificarC',$conductor->id)}}" method="post">
        <h2>Conductor:{{$conductor->nombre}} DNI:{{$conductor->dni}}<button type="submit">Salir</h2>
        <h2>Servicio:{{$servicios->id}} FECHA:{{$servicios->fecha}} RECAUDACION:{{$servicios->recaudacion}}</h2>

    </form>

 @if (session('mensaje'))
 <p style="color:red;">{{session('mensaje')}}</p>
@endif

<form action="{{route:('registrarB',$conductor->id)}}" method="post">

    <h1>Billetes</h1>
    <table border="1" width="50%">
        <tr>
            <td>Id</td>
            <td>Hora</td>
            <td>Precio</td>
            <td>Anulado</td>
            <td>Acciones</td>
        </tr>
       
    </table>
    

    
</body>
</html>