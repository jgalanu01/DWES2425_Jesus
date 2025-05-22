<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Videojuego</title>
</head>
<body>

    @if(session('mensaje'))
        <h2 style="color:red;">{{ session('mensaje') }}</h2>
    @endif

    <h3>Editar videojuego</h3>
    <a href="{{ route('rInicio') }}">Volver</a>

    <form action="{{ route('actualizarJuegoR', $juego->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="nombre">Nombre del juego</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $juego->nombre) }}">
        @error('nombre')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <br>

        <label for="plataforma">Plataforma</label>
        <input type="text" name="plataforma" id="plataforma" value="{{ old('plataforma', $juego->plataforma) }}">
        @error('plataforma')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <br>

        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" value="{{ old('precio', $juego->precio) }}" step="0.01">
        @error('precio')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <br>

        <label for="stock">Stock</label>
        <input type="number" name="stock" id="stock" value="{{ old('stock', $juego->stock) }}">
        @error('stock')
            <p style="color:red;">{{ $message }}</p>
        @enderror
        <br><br>

        <button type="submit">Actualizar</button>
    </form>

</body>
</html>
