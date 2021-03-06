<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recibo de Pago</title>
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
      <h1 class="tittle font">Recibo de Pago</h1>

      <div class="row mb-3" id="dates">
        <div class="col-sm-6 col-md-6" id="project">
          <div><span><strong>Cliente</strong></span> {{$sale->client->username}}</div>
          <div><span><strong>Correo</strong></span> <a href="mailto:{{$sale->client->email}}">{{$sale->client->email}}</a></div>
          <div><span><strong>Fecha</strong></span> {{ $sale->date }}</div>
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
            <th class="service"><strong>Cantidad</strong></th>
            <th class="desc"><strong>Código</strong></th>
            <th><strong>Descripción</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Total</strong></th>
          </tr>
        </thead>
        <tbody>
       
          @foreach($items as $item)
            <tr>
                <td class="service">{{$item->amount}}</td>
                <td class="desc">{{$item->product->product_sku}}</td>
                <td class="unit">{{$item->product->description}}</td>
                <td class="qty">${{number_format($item->product_price, 2)}}</td>
                <td class="total">${{number_format(($item->total), 2)}}</td>
            </tr>
          @endforeach
       
          <tr>
            <td colspan="4">Subtotal</td>
            <td class="total">${{number_format($sale->total, 2) }}</td>
          </tr>
          <tr>
            <td colspan="4">IVA</td>
            <td class="total">Incluido</td>
          </tr>  
          <tr>
            <td colspan="4" class="grand total">Total</td>
           
            <td class="grand total">${{number_format($sale->total, 2) }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div><strong>Forma de pago: {{$sale->pay_method==null ? 'No especificado' : $sale->pay_method }}</strong></div>
        <div><strong>{{config('configurations.mk.greetings')}}</strong></div>
        <div class="notice">{{config('configurations.mk.information_final_2')}}</div>
        <div class="notice">{{config('configurations.mk.information_final')}}</div>
        <div class="notice">{{config('configurations.mk.information_final_3')}}</div>
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