<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name=description content="A medium sized e-commerce shopping cart made by David Trushkov. Made using Laravel 5.2" />
        <meta name="keywords" content="shopping, ecommerce, store, electronics, electronics store, david, david trushkov, github, laravel, laravel 5, laravel 5.2" />
        <meta name="author" content="David Trushkov" />
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

         <link rel="stylesheet" type="text/css" href="/css/payments.css" data-rel-css="" />
        
        <script src="{{ asset('/js/bootstrap-notify.min.js')}}"></script>
        <!-- <link rel="stylesheet" href="{{ asset('/less/app.less') }}">

        <link rel="stylesheet" href="{{ asset('/sass/app.scss') }}"> -->
        
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/pay.css') }}" >
        <script type="text/javascript" src="{{ asset('/js/js.cookie.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/Main.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/ajax.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/ajax-client.js') }}"></script>
        @yield("ajax-shipment")
        <script>
            function borrarCache()
            {
                Cookies.remove("productos");
            }
        </script>   
        <script src="/js/index-stripe.js" data-rel-js></script>

        <!-- Openpay -->
        <script type="text/javascript" src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
        <script type='text/javascript' src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                   OpenPay.setId('mk5lculzgzebbpxpam6x');
                   OpenPay.setApiKey('pk_26757cbb5f7f44e8b31a2aed751c285c');
                   OpenPay.setSandboxMode(true);
           });
       </script>

        <!-- Material Design Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" >
     
        <script>
            // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            //             (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            //         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            // })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            // ga('create', 'UA-76800406-1', 'auto');
            // ga('send', 'pageview');
        </script>

    </head>
<body>
            
    @include('partials.nav')
            
   
    <div class="container">
    @if(Session::has('pay-success'))
        <script> 
            var notify = $.notify('<div class="alet alert-success" style="font-size:25px;"><h3>Compra existosa!!</h3>Revise su correo electrónico o su historial de compras para descargar su recibo</div>', { allow_dismiss: false });
        </script>
    @endif
        @yield('content')
          
    </div>
                
            
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
            // 
            var datos = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              prefetch: "/data"
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
    @yield('modal-paypal')
    @yield('styles')
    @yield('js')
    @yield('css-pay')
    @yield('js-pay')
    @yield('show-modal')
    @include('partials.flash')
    @include('partials.special_search')
    @include('customer.partials.add-address')

</body>
</html>
