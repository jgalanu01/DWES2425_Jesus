@extends('plantilla');

@if(session('mensaje'))
@section('info')
<h3 classw="text-success">{{session('mensaje')}}</h3>

@endsection
@endif
@if (session('error'))
@section('error')
<h3 class="text-danger">{{session('error')}}</h3>
@endsection
@endif

@section('main')
<table class="table">
    <thead>
        <tr>
       
            <td>Id</td>
            <td>Nombre</td>
            <td>Precio</td>
            <td>Stock</td>
            <td>Imagen</td>
            <td>Comprar</td>
            


        </tr>
    </thead>
    <tbody>
        @foreach($productos as $p)
        <tr>
            <td>{{$p->id}}</td>
            <td>{{$p->nombre}}</td>
            <td>{{$p->precio}}</td>
            <td>{{$p->stock}}</td>
            <td><img src="{{asset('img/productos/'.$p->imagen)}}" alt="{{$p->id}}" width="40px"></td>
            <form action="{{route('addCarrito',$p->id)}}" method="post">
                @csrf
              <td>  <button type="submit" name="btnAdd" value="{{$p->id}}" class="btn btn-outline-secondary">
                 <img src="{{asset('img/cesta.jpg')}}" alt="cesta" width="40px"></td>
                 </button>
            </form>
        </tr>
        @endforeach
    </tbody> 
</table>


@endsection