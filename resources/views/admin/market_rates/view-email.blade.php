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
<div class="col-md-6"><img src="{{asset(config('configurations.general.main_logo'))}}" style="width:100%; height:150px;"></div>
<h3>Se le adjunta la cotización realizada</h3>

<h3>Gracias por cotizar en Mercadata</h3>
</body>
</html>