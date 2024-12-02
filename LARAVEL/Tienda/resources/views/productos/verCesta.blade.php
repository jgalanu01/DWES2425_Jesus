@extends('plantilla');

@if(session('mensaje'))
@section('info')
<div class="alert alert-success" role="alert">
    {{ session('mensaje') }}
</div>
@endsection
@endif

@if(session('error'))
@section('error')
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endsection
@endif

@section('main')
<style>
    /* Estilo de la tabla */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    /* Encabezado de la tabla */
    .custom-table thead {
        background-color: #1e2a38; /* Color oscuro */
        color: #fff;
        font-size: 1.1em;
    }

    .custom-table th, .custom-table td {
        padding: 12px 16px;
        text-align: center;
        border: 1px solid #ddd;
    }

    /* Estilo de las filas */
    .custom-table tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .custom-table tbody tr:hover {
        background-color: #e1e1e1; /* Fondo gris claro al pasar el ratón */
    }

    /* Estilo para las imágenes */
    .custom-table td img {
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .custom-table td img:hover {
        transform: scale(1.1); /* Aumenta el tamaño de la imagen al pasar el ratón */
    }

    

    .custom-btn:hover {
        background-color: #45a049;
    }

    /* Mensajes de éxito y error */
    .alert-success {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        padding: 10px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
        font-weight: bold;
        padding: 10px;
        margin-bottom: 20px;
    }

</style>

<table class="custom-table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Producto</th>
            <th scope="col">Precio Unitario</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Precio Total</th>
            <th scope="col">Imagen</th>
            <th scope="col">Eliminar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productosC as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->producto->nombre }}</td>
            <td>{{ number_format($p->precioU, 2) }} €</td>
            <td>{{ $p->cantidad }}</td>
            <td>{{ number_format($p->cantidad * $p->precioU, 2) }} €</td>
            <td>
                <img src="{{ asset('img/productos/'.$p->producto->imagen) }}" alt="{{ $p->id }}" width="50px">
            </td>
            <form action="{{ route('addCarrito', $p->id) }}" method="post">
                @csrf
                <td>
                    <button type="submit" name="btnAdd" value="{{ $p->id }}" class="custom-btn">
                        <img src="{{ asset('img/cesta.jpg') }}" alt="cesta" width="30px">
                    </button>
                </td>
            </form>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
