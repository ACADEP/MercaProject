<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name=description content="A medium sized e-commerce shopping cart made by David Trushkov. Made using Laravel 5.2" />
        <meta name="keywords" content="mercadata, ecommerce, tienda, electronicos, tienda de electronicos" />
        
        <link rel="shortcut icon" href="{!! asset('/images/logo-mercadata.png') !!}" />

        <title>{{ config('app.name') }}</title>
        <!-- Font Awesome -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> -->
        <!-- Bootstrap core CSS -->
        <!-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> -->
        <!-- Material Design Bootstrap -->
        <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"> -->

        <!-- <link rel="stylesheet" href="{{ asset('/css/mdb.css') }}"> -->

        <!-- Payments css -->
        <link rel="stylesheet" href="{{ asset('/css/payments.css') }}">
       
        <!-- Include sweet alert file -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}"> -->
        <!-- Include typeahead file -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/typeahead.css') }}"> -->
        <!-- Include lity ligh-tbox file -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/lity.css') }}"> -->
      
       @yield('css-openpay')

        <!-- Added the main.css file that combines app.scss and app.css togather -->
        




        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}" ></script>
        
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <link href="{{ asset('/css/filters.css') }}" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="/css/payments.css" data-rel-css="" />
        
        <script src="{{ asset('/js/bootstrap-notify.min.js')}}"></script>
        <!-- <link rel="stylesheet" href="{{ asset('/less/app.less') }}">

        <link rel="stylesheet" href="{{ asset('/sass/app.scss') }}"> -->
        
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/pay.css') }}" >
        @stack('styles')
        @stack('scripts')
        <script type="text/javascript" src="{{ asset('/js/js.cookie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/Main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/ajax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/ajax-client.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/ajax-products.js') }}"></script>
        @yield("ajax-shipment")
        @yield('zoom-images')
        <script>
            function borrarCache()
            {
                Cookies.remove("productos");
            }
        </script>   

        <!-- Openpay -->
        <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
        <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                
                   OpenPay.setId("{{config('configurations.api.openpay_client_id')}}");
                   OpenPay.setApiKey("{{config('configurations.api.api_key_public_openpay')}}");
                   OpenPay.setSandboxMode(true);
           });
       </script>

        <!-- Material Design Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" >
     
       

    </head>
<body>

    @include('partials.nav')
    <div class="container">         
    <script>
        $(document).ready(function(){
            $("#success-pay").modal("show");

        });
    </script>
    
    
    @if(Session::has('progress'))
        @php Session::forget('progress'); @endphp
    @endif

    @if(Session::has('pay-oxxo'))
        <script>
            var notify = $.notify('<div>Recibo para pagar generado y enviado a su correo favor de <strong>imprimirlo</strong></div>', { allow_dismiss: false });
            window.open('/show-pdf-pay', '_blank');
        </script>
    @endif
    @if(Session::has('pay-bank'))
        <script>
            var notify = $.notify('<div>Recibo para pagar generado y enviado a su correo favor de <strong>imprimirlo</strong></div>', { allow_dismiss: false });
            window.open('/show-pdf-pay', '_blank');
        </script>    
    @endif
    @if(Session::has('pay-store'))
        <script>
            var notify = $.notify('<div>Recibo para pagar generado y enviado a su correo favor de <strong>imprimirlo</strong></div>', { allow_dismiss: false });
            window.open('/show-pdf-pay', '_blank');
        </script>       
    @endif
    @if(Session::has('recibe'))
        <script> 
            var notify = $.notify('<div>Recibo para pagar generado favor de <strong>imprimirlo</strong></div>', { allow_dismiss: false });
            window.open('/show-pdf-pay', '_blank');
        </script>
    @endif

    @if(Session::has('pay-success'))
        <script> 
            var notify = $.notify('<div style="font-size:25px;"><h3>Compra existosa!!</h3>Revise su correo electrónico o su historial de compras para descargar su recibo</div>', { allow_dismiss: false });
        </script>
    @endif

    @if(Session::has('pay-success-no-email'))
       
        <script> 
            var notify = $.notify('<div style="font-size:25px;">{{session("pay-success-no-email")}}</div>', { allow_dismiss: false });
        </script>
    @endif
        @yield('content')
          
    </div>
                
    {{-- @include("modals.success-payment")           --}}
    @include('pages.partials.footer')

    
    <!-- Include sweet-alert.js file -->
    <!-- <script type="text/javascript" src="{{ asset('/js/libs/sweetalert.js') }}"></script> -->
    <!-- Include typeahead.js file -->
    <!-- <script type="application/javascript" src="{{ asset('/js/libs/typeahead.js') }}"></script> -->
    <!-- Include lity light-box js file -->
    <!-- <script type="application/javascript" src="{{ asset('/js/libs/lity.js') }}"></script> -->

 
    
   
   
    

   
<style>
.team .row .col-md-4 {
    margin-bottom: 5em;
}
.team .row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
}
.team .row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}

.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {    /* used to be tt-dropdown-menu in older versions */
  width: 99%;
  margin-top: 4px;
  padding: 4px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
  padding: 3px 20px;
  line-height: 24px;
}

.tt-suggestion.tt-cursor,.tt-suggestion:hover {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}

.grow img
{
    transition: 1s ease;
}
    
.grow img:hover
{
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    transform: scale(1.2);
    transition: 1s ease;
}


        
</style>
   
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>
           
   
            $(function () {
            
            var datos = new Bloodhound({
                
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
            
             prefetch: {
                url: '/getData',
                ttl:0,
                cache: false,
            }
             
            }); 
            
            // inicializar typeahead sobre nuestro input de búsqueda
            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'datos',
                source: datos
            });
            
        });
    </script>
   
    @yield('modal-debit')
    
    @yield('styles')
    @yield('js')
    @yield('css-pay')
    @yield('js-pay')
    @yield('show-modal')
    @yield('modal-transfer')
    @yield('modal-store')
    @yield('modal-oxxo')
    @yield('scripts-progress')
    @include('partials.special_search')
    @include('customer.partials.add-address')
    @yield('modal-paypal')
    
    @stack('scripts')
    <script>
        var brands=[{{ App\Brand::pluck('id') }}];
    </script>
    {{-- <script src="/js/cva-products.js"></script> --}}

</body>
</html>
