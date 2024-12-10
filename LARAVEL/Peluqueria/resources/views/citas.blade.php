<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        /* Contenedor principal */
        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        input, button {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
            transition: all 0.3s;
        }

        input:focus, button:focus {
            border-color: #007BFF;
        }

        input[type="date"], input[type="time"] {
            width: 100%;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        p {
            color: red;
            font-size: 14px;
        }

        table {
            width: 100%;
            margin-top: 30px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f8f9fa;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .actions form {
            display: inline-block;
            margin: 0 5px;
        }

        .actions button {
            padding: 8px 12px;
            background-color: #28a745;
            border: none;
            color: white;
            font-size: 14px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #218838;
        }

        .actions button.delete {
            background-color: #dc3545;
        }

        .actions button.delete:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Formulario para crear -->
        <h1>Crear Cita</h1>
        <form action="{{route('crearC')}}" method="post">
            @csrf
            <input type="date" name="fecha" value="{{date ("Y-m-d")}}"/>
            @error('fecha')
                <p>Rellena Fecha</p>
            @enderror

            <input type="time" name="hora" value="{{date ("H:i")}}"/>
            @error('hora')
                <p>Rellena Hora</p>
            @enderror

            <input type="text" name="cliente" placeholder="Cliente"/>
            @error('cliente')
                <p>Rellena Cliente</p>
            @enderror

            <button type="submit">Crear Cita</button>
        </form>

        <!-- Mostrar los mensajes de error -->
        @if (@session('mensaje'))
            <p>{{session('mensaje')}}</p>
        @endif

        <!-- Tabla de citas -->
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Cliente</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citas as $c)
                    <tr>
                        <td>{{$c->id}}</td>
                        <td>{{$c->fecha}}</td>
                        <td>{{$c->hora}}</td>
                        <td>{{$c->cliente}}</td>
                        <td>{{$c->total}}</td>
                        <td class="actions">
                            <form action="{{route('cargarDetalle',$c->id)}}" method="get">
                                @csrf
                                <button type="submit" name="detalleC">Detalle</button>
                            </form>
                            <form action="{{route('borrarC',$c->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" name="borrarC" class="delete">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
