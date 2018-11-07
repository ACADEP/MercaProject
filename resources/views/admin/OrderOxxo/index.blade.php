@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Ordenes por pago Oxxo
        </h1> 
</section><br>
@if($orders->count()<=0)
 <div class="alert alert-info">No hay ordenes</div>
@else
<table class="table text-center">
    <thead>
            <tr>
                <th>#</th>
                <th>Nombre del cliente</th>
                <th>Monto</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->id}}</td>
                    @if($order->sale->client->customer !=null)
                    <td>{{$order->sale->client->customer->nombre.' '.$order->sale->client->customer->apellidos }}</td>
                    @else
                    <td>{{$order->sale->client->username }}</td>
                    @endif
                    <td>{{$order->sale->total}}</td>
                    <td>
                        <button class="btn btn-success">Acreditar pago</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@endif
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
    delay:3000
});
</script>
@endif
@stop


