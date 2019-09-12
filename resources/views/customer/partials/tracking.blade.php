@extends('customer.dash')

@section('content')
@php $ship_track=json_decode($track)  @endphp
    <div class="text-center"> <h1>Detalles del envío</h1>  </div>
    <hr>
    <div class="text-left border" style="font-size: 25px;">
        Paquetería: <span class="label label-primary">{{ $carrie }}</span> 
        @php
        if(strtolower($carrie)=="dhl")
        {
                $url_carrie="http://www.dhl.com.mx/es/express/rastreo.html";
        }
        else if(strtolower($carrie)=="fedex")
        {
                $url_carrie="https://www.fedex.com/apps/fedextrack/?action=track&cntry_code=mx";
        }
        else if(strtolower($carrie)=="ups")
        {
                $url_carrie="https://www.ups.com/track?loc=es_MX&requester=WT/";
        }
        else if(strtolower($carrie)=="redpack")
        {
            $url_carrie="http://www.redpack.com.mx/";
        }
        @endphp
        <a href="{{$url_carrie}}" style="font-size: 20px;">Ir a la página de rastreo</a><br><br>
        Estado del envío:<span class="label label-primary">{{ $ship_track->shipment_status }} </span> <br><br>
        Número de guía: <span class="label label-primary">{{$ship_track->carrier_tracking_number }}</span> <br><br>
        Fecha estimada de llegada: <span class="label label-primary">{{ $ship_track->expected_delivery_date }} </span><br><br>
    </div>

@stop