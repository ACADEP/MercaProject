@extends('seller.dash')

@section('content')

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
    <div class="text-left">
        {{ $seleHistories->links() }}
    </div>
    
@stop