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
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recibo de Pago</title>
    <link rel="stylesheet" href="{{ asset('/css/InvoicePayment.css') }}" media="all" />
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
  </head>
  <body>
    @php  $now = new \DateTime(); @endphp
    <header class="clearfix">
      <div id="logo">
          <div class="mercaLogo">
            <img src="{{asset('/images/mercadata-footer.png')}}">
          </div>
            <div class="slogan">
                <strong><h3>MercaData</h3></strong>
                Tu tienda de tecnologia en línea 
            </div>
      </div>
      <h1>Cotización</h1>
      
      <div id="company" class="clearfix">
        <div><strong>Mercadata</strong></div>
        <div>Ignacio Allende,<br /> La Paz 23000, MX</div>
        <div>Tel: 612 122 5174</div>
        <div><a href="mailto:mercadata@acadep.com">mercadata@acadep.com</a></div>
      </div>
      <div id="project">
        <div><span><strong>Correo</strong></span> <a href="mailto:{{$items->email}}">{{$items->email}}</a></div>
        <div><span><strong>Fecha</strong></span> {{ $now->format('d-m-Y') }}</div>
        <div><span><strong>Expiración</strong></span> {{Carbon\Carbon::now()->addDay(1)}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service"><strong>Cantidad</strong></th>
            <th class="desc"><strong>Código</strong></th>
            <th><strong>Descripción</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Total</strong></th>
          </tr>
        </thead>
        <tbody>
          @foreach($items->MarketRatesDetails()->get() as $item)
            <tr>
                <td class="service">{{$item->qty}}</td>
                <td class="desc">{{$item->product_sku}}</td>
                <td class="unit">{{$item->description}}</td>
                <td class="qty">${{number_format($item->price, 2)}}</td>
                <td class="total">${{number_format(($item->subtotal), 2)}}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="4">Subtotal</td>
            <td class="total">${{number_format($items->total, 2) }}</td>
          </tr>
          <tr>
            <td colspan="4">IVA</td>
            <td class="total">Incluido</td>
          </tr>
          <tr>
            <td colspan="4">Costo de envío</td>
            <td class="total">En sitio</td>
          </tr>    
          <tr>
            <td colspan="4" class="grand total">Total</td>
            <td class="grand total">${{number_format($items->total, 2) }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div><strong>Forma de pago: </strong>Tranferencia</div>
        <div><strong>Tiempo de Entrega:</strong>3 a 5 dias habiles</div>
        <div><strong>¡Gracias por hacer su compra!</strong></div>
        <div class="notice">* Precios sujetos a cambio sin precio aviso.</div>
        <div class="notice">En espera de vernos favorecidos con su pedido, nos ponemos a sus ordenes para cualquier aclaración.</div>
      </div>
    </main>
    <footer>
        <div class="row data">
            <div class="address">
                <span>Dirección:</span><br>
                <strong>La Paz, BCS México</strong>
            </div>
            <div class="phone">
                <span>Teléfono: </span><br>
                <strong>612 1225174</strong>
            </div>
        </div>
    </footer>
  </body>
</html>