<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
       
        <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/css/payments.css') }}">
       
        <link rel="stylesheet" href="{{ asset('/css/lity.css') }}">
        
        <!-- Added the main.css file that combines app.scss and app.css togather -->

        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}" ></script>
        
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    </head>
<body>
<div class="container">
@php  $now = new \DateTime(); @endphp
<div class="row text-center">
        <div class="col-md-6 text-left"><img src="{{asset(config('configurations.general.main_logo'))}}" width="250px"></div>
        <div class="col-md-6 text-right">
            <strong><h3>{{config('configurations.general.store_name')}}</h3></strong>
            {{config('configurations.mk.slogan')}} <hr><br>
            <h4><strong>La Paz, BCS. </strong></h4>
            <h4><strong>{{ $now->format('d-m-Y') }}</strong></h4>
        </div>
</div><!-- fin row 1-->
<br>
<div class="row text.center">
    <div class="col-md-6 text-left"><h2>Recibo de pago</h2>Cliente: {{ Auth::User()->username}}</div>
    <div class="col-md-6 text-right"><strong><h3>Teléfono(s): 612 1225174</h3></strong></div>
</div><!-- fin row 2-->
<br>
<table class="table">
        <thead>
                <tr>
                    <th>Cantidad</th>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Precio</th>
                    <th>SubTotal</th>
                </tr>
        </thead>
        <tbody>
                @foreach($cartItems as $item)
                    <tr>
                        <td>{{$item->qty}}</td>
                        <td>{{$item->product_sku}}</td>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->description}}</td>
                        <td>${{number_format($item->product_price, 2)}}</td>
                        <td>${{number_format($item->total, 2)}}</td>
                    </tr>
                @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="text-left col-md-6">
            <strong>Subtotal con iva: </strong>${{number_format($subtotal, 2) }} <br>
            <strong>Costo de envio: </strong>${{number_format(0, 2) }} <br>
            <strong>Total: </strong>${{number_format($subtotal, 2) }} <br>
        </div>
        <div class="text-right col-md-6">
        <h5>Envio a:</h5>
            <div class="border">
                <strong>CP:</strong>{{$address->cp}} <strong>Ciudad:</strong>{{ $address->ciudad }} {{$address->estado}} <br>
                {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} colonia: {{ $address->colonia }}
            </div>
        </div>
    </div>
    

<footer style="margin-top:100px;">
<div class="text-center">
    Atentamente <br>
    <strong>Mercadata</strong>
</div>
<div class="row">
    <div class="text-left col-md-6">
        <strong>La Paz,BCS México</strong>
    </div>

    <div class="text-right col-md-6">
        <strong>Telefono: 612 1225174</strong>
    </div>
</div>

</footer>

</div><!-- fin content-->
    


</body>
</html>




