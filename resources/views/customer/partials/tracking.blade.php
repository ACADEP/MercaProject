@extends('customer.dash')

@section('content')
@php $ship_track=json_decode($track)  @endphp
    <div class="text-center"> <h1>Detalles del envío</h1>  </div>
    <hr>
    <div class="text-left border" style="font-size: 25px;">
        Paquetería: <span class="label label-primary">{{ $carrie }}</span> <br><br>
        Estado del envío:<span class="label label-primary">{{ $ship_track->shipment_status }} </span> <br><br>
        Número de guía: <span class="label label-primary">{{$ship_track->carrier_tracking_number }}</span> <br><br>
        Fecha estimada de llegada: <span class="label label-primary">{{ $ship_track->expected_delivery_date }} </span><br><br>
    </div>

@stop