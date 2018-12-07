<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recibo de pago</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/InvoicePayment.css') }}" media="all" />
  </head>
  <body>
    @php  $now = new \DateTime(); @endphp
    <header class="clearfix">
      <div id="logo">
          <div class="mercaLogo">
            <img src="{{asset(config('configurations.general.main_logo'))}}">
          </div>
            <div class="slogan font">
                <strong><h3>{{config('configurations.general.store_name')}}</h3></strong>
                {{config('configurations.mk.slogan')}}
            </div>
      </div>
      <h1 class="tittle font">Recibo de pago</h1>

      <div class="row mb-3" id="dates">
        <div class="col-sm-6 col-md-6" id="project">
          <div><span><strong>Cliente</strong></span> {{ Auth::user()->username }}</div>
          <div><span><strong>Correo</strong></span>{{ Auth::user()->email }}</div>
          <div><span><strong>Fecha</strong></span> {{ $now->format('d-m-Y') }}</div>
        </div>
    
        <div class="col-sm-6 col-md-6 text-right" id="company" class="clearfix font">
          <div><strong>{{config('configurations.general.store_name')}}</strong></div>
          <div>{{config('configurations.company.direction_1')}},<br /> 
                {{config('configurations.company.city')}} {{config('configurations.company.postal_code')}}, 
                {{config('configurations.company.country_code')}}</div>
          <div>Tel:  {{config('configurations.company.phone')}}</div>
          <div><a href="mailto:mercadata@acadep.com">mercadata@acadep.com</a></div>
        </div>  
      </div>

      <div class="row mt-5"></div>
    </header>
    <main>
    <table>
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
                @foreach($sale->customerHistories()->with("product")->get() as $item)
                    <tr class="text-center">
                        <td>{{$item->amount}}</td>
                        <td>{{$item->product->product_sku}}</td>
                        <td>{{$item->product->product_name}}</td>
                        <td>{{$item->product->description}}</td>
                        <td>${{number_format($item->product_price, 2)}}</td>
                        <td>${{number_format(($item->amount*$item->product_price), 2)}}</td>
                    </tr>
                @endforeach
                <tr class="text-right">
                    <td colspan="5">IVA</td>
                    <td class="total">Incluido</td>
                </tr>
                <tr class="text-right">
                    <td colspan="5" class="grand total">Total</td>
                    <td class="grand total">${{number_format($sale->total, 2) }}</td>
                </tr>
        </tbody>
    </table>
      <div id="notices">
      <!-- <div><strong>Forma de pago: Transferencia</strong></div> -->
    <div><strong>¡Gracias por hacer su compra!</strong></div>
    <div class="notice">* Precios sujetos a cambio sin precio aviso.</div>
    <div class="notice">{{config('configurations.mk.information_final')}}</div>
    <div class="notice">A partir de 24 horas tiene 7 días para solicitar su factura al correo de Mercadata.</div>
      </div>
    </main>
    <footer>
        <div class="row data">
            <div class="address">
                <span>Dirección:</span><br>
                <strong>{{config('configurations.company.city')}} {{config('configurations.company.postal_code')}}, 
                {{config('configurations.company.country_code')}}</strong>
            </div>
            <div class="phone">
                <span>Teléfono: </span><br>
                <strong> {{config('configurations.company.phone')}}</strong>
            </div>
        </div>
    </footer>
  </body>
</html>