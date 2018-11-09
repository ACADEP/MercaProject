@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Ordenes por pago Oxxo
        </h1> 
</section><br>
<div id="body-orders-oxxo">
@if($orders->count()<=0)
 <div class="alert alert-info">No hay ordenes</div>
@else
<table class="table text-center">
    <thead>
            <tr>
                <th>#</th>
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
                    <td>{{$order->id}}</td>
                    @if($order->sale->client->customer !=null)
                    <td>{{$order->sale->client->customer->nombre.' '.$order->sale->client->customer->apellidos }}</td>
                    @else
                    <td>{{$order->sale->client->username }}</td>
                    @endif
                    <td>{{$order->sale->client->email}}</td>
                    <td>{{$order->sale->total}}</td>
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


