<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
</head>
<body>
    <form action="{{route('registrar')}}" method="POST">
        @csrf

        Nombre
        <input type="text" name="nombre" value="{{old('nombre')}}"/><!--Old es para recordar en el formulario -->
        @error('nombre')
        <h3>Rellena el nombre</h3>;
        <h3>{{$message}}</h3>;
            @enderror
        <br/> 
        Email
        <input type="email" name="email" value="{{old('email')}}"/>
        @error('email')
        <h3>{{$message}}</h3>
            @enderror
        <br/>
        Pass
        <input type="password" name="ps"/>
        @error('ps')
            <h3>{{$message}}</h3>
            @enderror
        <br/>
        Confirmar Contraseña
        <input type="password" name="ps2"/>
        @error('ps2')
            <h3>{{$message}}</h3>
            @enderror
        <br/>

        <button type="submit" name="crearU">Crear</button>
        <a href="{{route("vistaLogin")}}">Volver</a>
        

  
    </form>

    @if (session('mensaje'))
   {{session('mensaje')}};


    @endif


    
</body>
</html>