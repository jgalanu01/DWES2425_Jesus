<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Billetes</title>
</head>
<body>

    @if (session('mensaje'))
        <p style="color:red;">{{ session('mensaje') }}</p>
    @endif

    @if (session('info'))
        <p style="color:green;">{{ session('info') }}</p>
    @endif

    <h2>Conductor: {{ $conductor->nombre }} | DNI: {{ $conductor->dni }}</h2>
    <a href="{{ route('inicioR') }}">Salir</a>

    <h3>Servicio: {{ $servicio->id }} | Fecha: {{ $servicio->fecha }} | Recaudación: {{ $servicio->recaudacion }} €</h3>

    <h3>Registrar nuevo billete</h3>
    <form action="" method="post">
        @csrf
        <label for="tipo">Tipo de Billete:</label>
        <select name="tipo" id="tipo">
            <option value="normal">Normal-1.50</option>
            <option value="reducido">Reducido-1.00</option>
        </select>
        <br><br>
        <button type="submit">Registrar Billete</button>
    </form>

    <h3>Billetes Vendidos</h3>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Hora</th>
            <th>Precio</th>
            <th>Anulado</th>
            <th>Acciones</th>
        </tr>
       
    </table>

</body>
</html>
