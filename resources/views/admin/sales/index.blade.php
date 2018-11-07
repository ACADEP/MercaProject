@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Ventas
        </h1> 
</section><br>
@include('admin.sales.order-sales')
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
        @if($sales->count()>0)
            @foreach($sales as $history)
                <tr>
                    <td ><img src="{{ $history->product->photos->first()->path }}" height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->product->price, 2)}}</td>
                    <td>{{ $history->client }}</td>
                    <td>{{$history->date}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>${{number_format($history->total, 2)  }}</td>
                </tr>
            @endforeach
        @else
        <tr>
           <td>No hay ventas</td> 
        </tr>
        @endif
        </tbody>
    
    </table>
    <div class="text-center">
        {{ $sales->links() }}
    </div>
    

@stop