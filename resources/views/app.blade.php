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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Bootstrap core CSS -->
        <!-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> -->
        <!-- Material Design Bootstrap -->
        <link href="{{asset('css/mdb.min.css')}}" rel="stylesheet">
        <!-- Your custom styles (optional) -->
        <!-- <link href="css/style.css" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}"> -->

        <!-- <link rel="stylesheet" href="{{ asset('/css/mdb.css') }}"> -->

       
        <!-- Include sweet alert file -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/sweetalert.css') }}"> -->
        <!-- Include typeahead file -->
        <!-- <link rel="stylesheet" href="{{ asset('/css/typeahead.css') }}"> -->
        <!-- Include lity ligh-tbox file -->
        <link rel="stylesheet" href="{{ asset('/css/lity.css') }}">
        
        <!-- Added the main.css file that combines app.scss and app.css togather -->
        
        <!-- Scripts -->
        <script src="{{ asset('/js/app.js') }}" ></script>
        
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">

        <!-- <link rel="stylesheet" href="{{ asset('/less/app.less') }}">

        <link rel="stylesheet" href="{{ asset('/sass/app.scss') }}"> -->
        
        <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('/css/main.css') }}">
        
        
        
       
        
        <!-- Material Design Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- Font Awesome -->
        <!-- <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" > -->

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
       
        @yield('content')
          
    </div>
                
            
     @include('pages.partials.footer')

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Include sweet-alert.js file -->
    <!-- <script type="text/javascript" src="{{ asset('/js/libs/sweetalert.js') }}"></script> -->
    <!-- Include typeahead.js file -->
    <!-- <script type="application/javascript" src="{{ asset('/js/libs/typeahead.js') }}"></script> -->
    <!-- Include lity light-box js file -->
    <!-- <script type="application/javascript" src="{{ asset('/js/libs/lity.js') }}"></script> -->
    <!-- Stripe.js file -->
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript" src="{{ asset('/js/Main.js') }}"></script>
    <script src="{{ asset('/js/ajax.js') }}"></script>

    <script>
        (function(w,d,s,g,js,fs){
            g=w.gapi||(w.gapi={});g.analytics={q:[],ready:function(f){this.q.push(f);}};
            js=d.createElement(s);fs=d.getElementsByTagName(s)[0];
            js.src='https://apis.google.com/js/platform.js';
            fs.parentNode.insertBefore(js,fs);js.onload=function(){g.load('analytics');};
        }(window,document,'script'));
    </script>
    <script>
        gapi.analytics.ready(function() {
            /**
             * Authorize the user immediately if the user has already granted access.
             * If no access has been created, render an authorize button inside the
             * element with the ID "embed-api-auth-container".
             */
            gapi.analytics.auth.authorize({
                container: 'embed-api-auth-container',
                clientid: 'YOUR CLIENT ID'
            });
            /**
             * Create a new ViewSelector instance to be rendered inside of an
             * element with the id "view-selector-container".
             */
            var viewSelector = new gapi.analytics.ViewSelector({
                container: 'view-selector-container'
            });
            // Render the view selector to the page.
            viewSelector.execute();
            /**
             * Create a new DataChart instance with the given query parameters
             * and Google chart options. It will be rendered inside an element
             * with the id "chart-container".
             */
            var dataChart = new gapi.analytics.googleCharts.DataChart({
                query: {
                    metrics: 'ga:sessions',
                    dimensions: 'ga:date',
                    'start-date': '30daysAgo',
                    'end-date': 'yesterday'
                },
                chart: {
                    container: 'chart-container',
                    type: 'LINE',
                    options: {
                        width: '100%'
                    }
                }
            });
            /**
             * Render the dataChart on the page whenever a new view is selected.
             */
            viewSelector.on('change', function(ids) {
                dataChart.set({query: {ids: ids}}).execute();
            });
        });
    </script>
    <script>
        // your publish key
        Stripe.setPublishableKey('YOUR STRIPE PUBLISHABLE KEY');
        //
        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                var $form = $(this);
                // Disable the submit button to prevent repeated clicks
                $form.find($('.btn')).prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                // Prevent the form from submitting with the default action
                return false;
            });
        });
        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                // Show the errors on the form
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').removeClass("hidden");
                $form.find($('.btn')).prop('disabled', false);
            } else {
                // response contains id and card, which contains additional card details
                var token = response.id;
                // Insert the token into the form so it gets submitted to the server
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                // and submit
                $form.get(0).submit();
            }
        }
    </script>
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

#form-add-cart{

   
  
}

        
</style>
   
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>
           
            $(function () {
            // 
            var datos = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              prefetch: '{{ url("/data") }}'
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
    <script>
        new WOW().init();
    </script>
    @yield('styles')
    @yield('js')
    @include('partials.flash')
    @include('partials.special_search')

</body>
</html>
