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
            <img src="{{asset('/images/mercadata-footer.png')}}">
          </div>
            <div class="slogan font">
            <strong><h3>{{config('configurations.general.store_name')}}</h3></strong>
                {{config('configurations.mk.slogan')}} 
            </div>
      </div>
      <h1 class="tittle font">Recibo de Pago</h1>
      
      <div class="row mb-3" id="dates">
        <div class="col-sm-6 col-md-6" id="project">
          <div><span><strong>Cotización</strong></span> {{ $items->id}}</div>
          <div><span><strong>Cliente</strong></span> {{ $items->company}}</div>
          <div><span><strong>Correo</strong></span> <a href="mailto:{{$items->email}}">{{$items->email}}</a></div>
          <div><span><strong>Fecha</strong></span> {{ $now->format('d-m-Y') }}</div>
          <div><span><strong>Expiración</strong></span> {{Carbon\Carbon::now()->addDay(1)}}</div>
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

      <div class="bank">
        <div><h3>Depósito a través de OXXO a cuenta BBVA Bancomer</h3></div>
        <div><span><strong>Propietario de la cuenta: </strong>Leonardo Lage Suarez</span></div>
        <div><span><strong>Cuenta: </strong>0136602037</span></div>
        <div><span><strong>Clabe: </strong>012040001366020373</span></div>
        <div><span><strong>Teléfono: </strong>612 122 5174</span></div>
        <div><span><strong>Correo: </strong><a href="mailto:administracion@acadep.com">administracion@acadep.com</a></span></div>
        <div><span><strong>Fecha límite de pago: </strong>{{Carbon\Carbon::now()->addDay(1)}}</span></div>
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
            <td class="grand total">${{number_format( $items->total, 2) }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div><strong>Forma de pago: </strong>Tranferencia</div>
        <div><strong>Tiempo de Entrega: </strong>3 a 5 dias habiles</div>
        <div><strong>{{config('configurations.mk.greetings')}}</strong></div>
        <div class="notice">{{config('configurations.mk.information_final_2')}}</div>
        <div class="notice">{{config('configurations.mk.information_final')}}</div>
      </div>
    </main>
    <footer>
        <div class="row data">
            <div class="address">
                <span>Dirección: </span>
                <strong>{{config('configurations.company.city')}} {{config('configurations.company.postal_code')}}, 
                {{config('configurations.company.country_code')}}</strong>
            </div>
            <div class="phone">
                <span>Teléfono: </span>
                <strong> {{config('configurations.company.phone')}}</strong>
            </div>
        </div>
    </footer>
  </body>
</html>
       