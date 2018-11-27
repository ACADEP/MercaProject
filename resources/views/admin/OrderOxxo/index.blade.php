@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Ordenes por pago Oxxo
        </h1> 
</section><br>
<div id="body-orders-oxxo">
<div class="col-md-6 form-inline">
<form action="{{route('search-orderOxxo')}}" method="get">
    <input type="seacrh" class="form-control" placeholder="Buscar por número de cotización" autocomplete="off" style="width:60%;" name="search" > 
    <button type="sumbit" class="btn btn-primary">Buscar</button>
</form>
<br>
</div>
@if($orders->count()<=0)
 <div class="alert alert-info col-md-12">No hay ordenes</div>
@else

<table class="table text-center">
    <thead>
            <tr>
                <th>Num. Cotización</th>
                <th>Nombre del cliente</th>
                <th>Email</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr id="order{{$order->id}}">
                    <td>{{$order->market_id}}</td>
                    @if($order->sale->client->customer !=null)
                    <td>{{$order->sale->client->customer->nombre.' '.$order->sale->client->customer->apellidos }}</td>
                    @else
                    <td>{{$order->sale->client->username }}</td>
                    @endif
                    <td>{{$order->sale->client->email}}</td>
                    <td>${{number_format($order->sale->total, 2)}}</td>
                    <td>{{$order->created_at}}</td>
                    <td>
                        <form style="display:inline;" method="post" action="{{route('accreditedPay')}}">
                            {{csrf_field()}}
                            <input type="hidden" name="order" value="{{$order->id}}">
                            <button class="btn btn-success btn-xs">Acreditar pago</button>
                        </form>
                        <button class="btn btn-danger btn-xs btn-order-delete" data-toggle="tooltip" value="{{$order->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@endif
</div>

@stop


@section('msg-success')
@if(Session::has("success"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("success")}}</strong>' 
},{
    // settings
    type: 'success',
    delay:5000
});
</script>
@endif
@stop


