@extends('seller.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/seller/admin') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Historial de Ventas</li>
    </ol>
</nav>          

<section class="content-header">
        <h1>
            Mi historial de ventas
        </h1>   
</section><br>

 @include('seller.partials.order-histories')
    
    <table class="text-center table">
    <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre del producto</th>
                <th>Precio unt</th>
                <th>Cliente</th>
                <th>Fecha de la venta</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
        @if($seleHistories->count()>0)
            @foreach($seleHistories as $history)
                <tr>
                    <td ><img  src="{{ $history->product->photos->first()->path }}"  height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->product->price, 2)}}</td>
                    <td>{{ $history->client }}</td>
                    <td>{{$history->date}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>${{number_format($history->total, 2)  }}</td>
                </tr>
            @endforeach
        @else
        
        @endif
        </tbody>
    
    </table>
    <div class="text-center">
        {{ $seleHistories->links() }}
    </div>
    
@stop