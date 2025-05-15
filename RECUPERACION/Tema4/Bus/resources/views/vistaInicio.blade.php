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


    <form action="{{route('billetesR')}}" method="post">
     @csrf
    <label for="conductor">Conductor</h3>
    <input type="text" name="conductor" id="conductor" placeholder="Rellena el dni"> 
    <br>
    <button type="submit">Ir a servicio</button>  

    </div>
    
</body>
</html>