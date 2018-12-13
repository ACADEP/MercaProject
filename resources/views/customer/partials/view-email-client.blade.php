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
    <div class="col-md-12"><img src="{{asset(config('configurations.general.main_logo'))}}" style="width:50%; height:150px;"></div>
    <h1>Hola {{$client->username}}</h1>
    <h3>Se le ajunta el recibo de pago de su compra</h3>
    <h2>Datos del envío</h2>
    <img src="{{ $img_carrie }}" class="img-thumbnail">
    <h3>Número de guía: </h3>{{$guia}} <br>
    <a href="{{$url}}" target="_blank" style="color:blue;">Ir a la página de rastreo</a>
    <h3>¡Gracias por comprar en Mercadata!</h3>
</body>
</html>