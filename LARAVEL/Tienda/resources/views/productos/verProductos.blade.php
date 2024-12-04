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
    /* Estilo general de la tabla */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: #fafafa;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Encabezado de la tabla */
    .custom-table thead {
        background-color: #3b3b3b; /* Gris oscuro */
        color: white;
        text-transform: uppercase;
    }

    .custom-table th, .custom-table td {
        padding: 12px 18px;
        text-align: center;
        border: 1px solid #ddd;
        font-size: 1rem;
    }

    /* Filas alternadas */
    .custom-table tbody tr:nth-child(odd) {
        background-color: #f4f4f4;
    }

    /* Efecto hover sobre las filas */
    .custom-table tbody tr:hover {
        background-color: #d6f5d6; /* Verde suave al pasar el ratón */
    }

    /* Estilo de las imágenes */
    .custom-table td img {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .custom-table td img:hover {
        transform: scale(1.05); /* Zoom de la imagen */
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.3);
    }


    .custom-btn:hover {
        background-color: #45a049;
    }

    /* Mensajes de éxito y error */
    .alert-success {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        padding: 12px;
        margin-bottom: 20px;
        text-align: center;
    }

    .alert-danger {
        background-color: #dc3545;
        color: white;
        font-weight: bold;
        padding: 12px;
        margin-bottom: 20px;
        text-align: center;
    }
</style>

<table class="custom-table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Precio</th>
            <th scope="col">Stock</th>
            <th scope="col">Imagen</th>
            <th scope="col">Comprar</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $p)
        <tr>
            <td>{{ $p->id }}</td>
            <td>{{ $p->nombre }}</td>
            <td>{{ number_format($p->precio, 2) }} €</td>
            <td>{{ $p->stock }}</td>
            <td><img src="{{ asset('img/productos/'.$p->imagen) }}" alt="{{ $p->id }}" width="50px"></td>
            <form action="{{ route('addCarrito', $p->id) }}" method="post">
                @csrf
                <td>
                    <button type="submit" name="btnAdd" value="{{ $p->id }}" class="custom-btn">
                        <img src="{{ asset('img/cesta.jpg') }}" alt="cesta" width="50px">
                    </button>
                </td>
            </form>
        </tr>
        @endforeach
    </tbody> 
</table>

@endsection
