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
<h1>Hola {{$client->username}}</h1>
<h3>Se le ajunta el recibo para pagar en tiendas oxxo</h3>
<img src="{{asset('/images/shipments/oxxo.png')}}" class="img-thumbnail">
<div class="alert alert-info"><h3>Favor de enviar una foto del baucher o recibo de pago por este medio para la acreditación de compra</h3></div>
<h3>¡Gracias!</h3>

</body>
</html>