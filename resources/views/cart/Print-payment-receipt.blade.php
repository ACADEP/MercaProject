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

        <style>
                /** Define the margins of your page **/
            @page {
                margin: 100px 25px;
            }

            header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 100px;

                /** Extra personal styles **/
                background-color: #bbdefb;
                color: black;
                text-align: center;
                line-height: 25px;
            }

            footer {
                position: fixed; 
                bottom: -60px; 
                left: 0px; 
                right: 0px;
                height: 100px; 

                /** Extra personal styles **/
                background-color: #bbdefb;
                color: black;
                text-align: center;
                line-height: 25px;
            }
            table.table-bordered {
                border:1px solid black;
                margin-top:20px;
            }
            table.table-bordered > thead > tr > th {
                border:1px solid black;
            }
            table.table-bordered > tbody > tr > td {
                border:1px solid black;
            }
            
            table th {
                background-color: #bdbdbd;
                color: #000;
            }
            table {
                float: inherit;
            }
            </style>
    </head>
<body>
<div class="container">
    @php  $now = new \DateTime(); @endphp

    <!-- Define header and footer blocks before your content -->
    <header>
        <div class="row text-center">
                <div class="col-md-6 text-left"><img src="{{asset('/images/mercadata-footer.png')}}" width="250px"></div>
                <div class="col-md-6 text-right">
                    <strong><h3>MercaData</h3></strong>
                    Tu tienda de tecnologia en línea 
                </div>
        </div><!-- fin row 1-->        
    </header><hr><br>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <div class="col-md-6 text-right">
            <h4><strong>La Paz, BCS.</strong></h4>
            <h4><strong>{{ $now->format('d-m-Y') }}</strong></h4><br>
        </div>
        <div class="row text-center">
            <div class="col-md-12 text-left">
                <h2>Recibo de pago</h2>
                <h4>Depósito a través de OXXO o BBVA Bancomer</h4>
                <h5>Propietario de la cuenta: German Leonardo Lage Suarez</h5>
                <h5>Cuenta: 0136602037</h5>
                <h5>Clave: 012040001366020373</h5>
                <h5>Teléfono: 612 122 5174</h5>
                <h5>Correo: administracion@acadep.com</h5>
                <h5>Fecha límite de pago: {{$expiry}}</h5><br>
            </div>                
        </div>
        <div class="row text-center">
            <div class="col-md-6 text-left">
                <h5>Cliente: {{ Auth::User()->username}}</h5>
                <h5>Teléfono(s): 612 1225174</h5>
            </div>
        </div><!-- fin row 2-->
        <br>
        <div class="col-md-8 col-md-offset-2">
            <table class="table-bordered text-center">
                <thead>
                    <tr>
                        <th>&nbsp;Cantidad </th>
                        <th>&nbsp;Código </th>
                        <th>&nbsp;Nombre </th>
                        <th>&nbsp;Descripcion </th>
                        <th>&nbsp;Precio </th>
                        <th>&nbsp;SubTotal </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>&nbsp;{{$item->qty}} </td>
                            <td>&nbsp;{{$item->product_sku}} </td>
                            <td>&nbsp;{{$item->product->product_name}} </td>
                            <td>&nbsp;{{$item->description}} </td>
                            <td>&nbsp;${{number_format($item->product_price, 2)}} </td>
                            <td>&nbsp;${{number_format($item->total, 2)}} </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>    
    <br>
    <div class="row">
        <div class="text-left col-md-6">
            <strong>Subtotal con iva: </strong>${{number_format($subtotal, 2) }} <br>
            <strong>Costo de envio: </strong>${{number_format(0, 2) }} <br>
            <strong>Total: </strong>${{number_format($subtotal, 2) }} <br>
        </div>
        <div class="text-right col-md-6">
        <h5>Envío a:</h5>
            <div class="border">
                <strong>CP: </strong>{{$address->cp}} <strong>Ciudad: </strong>{{ $address->ciudad }} {{$address->estado}} <br>
                {{$address->calle}} entre {{ $address->calle2 }} y {{ $address->calle3 }} colonia: {{ $address->colonia }}
            </div>
        </div>
    </div>
    
    <footer>
        <div class="text-center">
            Atentamente <br>
            <strong>Mercadata</strong>
        </div>
        <div class="row data">
            <div class="text-left city col-md-4">
                <strong>La Paz,BCS México</strong>
            </div>
            <div class="text-right phone col-md-4">
                <strong>Telefono: 612 1225174</strong>
            </div>
        </div>
    </footer>

</div><!-- fin content-->

</body>
</html>