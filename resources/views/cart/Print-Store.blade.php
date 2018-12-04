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
                <strong><h3 class="font">{{config('configurations.general.store_name')}}</h3></strong>
                {{config('configurations.mk.slogan')}} 
            </div>
      </div>
      <h1 class="tittle font">Recibo de Pago</h1>
      
      <div class="row" id="dates">
        <div class="col-sm-6 col-md-6" id="project">
          <div><span><strong>Cliente</strong></span> {{Auth::User()->customer->telefono}}</div>
          <div><span><strong>Dirección</strong></span> {{ Auth::user()->addressActive()->calle}}, {{ Auth::user()->addressActive()->ciudad}} {{ Auth::user()->addressActive()->cp}}, {{ Auth::user()->addressActive()->estado}}</div>
          <div><span><strong>Correo</strong></span> <a href="mailto:{{Auth::User()->email}}">{{Auth::User()->email}}</a></div>
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

      <div class="row" id="servicio">
        <div class="col-sm-6 col-md-6" id="codigo">
          <div><img src="{{$charge->payment_method->barcode_url}}" width="250px" height="80px" alt=""></div>
          <div><span>{{$charge->payment_method->reference}}</span></div>
        </div>
    
        <div class="col-sm-6 col-md-6 text-right" id="paynet">
          <div>Servicio a pagar</div>
          <div><img src="{{asset('/images/Openpay/paynet_logo.png')}}" alt="Logo Paynet" width="150px" height="50px"></div>
        </div>  
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
          @foreach($itemsCart as $item)
            <tr>
                <td class="service">{{$item->qty}}</td>
                <td class="desc">{{$item->product->product_sku}}</td>
                <td class="unit">{{$item->product->description}}</td>
                <td class="qty">${{number_format($item->product_price, 2)}}</td>
                <td class="total">${{number_format($item->total, 2)}}</td>
            </tr>
          @endforeach
          <tr>
            <td colspan="4">Subtotal</td>
            <td class="total">${{number_format( Auth::user()->total, 2) }}</td>
          </tr>
          <tr>
            <td colspan="4">IVA</td>
            <td class="total">Incluido</td>
          </tr>
          <tr>
            <td colspan="4">Costo de envío</td>
            <td class="total">{{$ship_rate}}</td>
          </tr>    
          <tr>
            <td colspan="4" class="grand total">Total</td>
            <td class="grand total">${{number_format( $ship_rate_total, 2) }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div><strong>Forma de pago: </strong>Oxxo</div>
        <div><strong>Tiempo de Entrega: </strong>{{$date_ship}}</div>
        <div><strong>¡Gracias por hacer su compra!</strong></div>
        <div class="notice">* Precios sujetos a cambio sin precio aviso.</div>
        <div class="notice">En espera de vernos favorecidos con su pedido, nos ponemos a sus ordenes para cualquier aclaración.</div>
      </div>

      <br>
      <h3 class="tittle font">Pasos para realizar el pago</h3>
      <div class="row" id="pago">
        <div class="col-sm-6 col-md-6" id="bancomer">
          <div><h4>Como realizar el pago</h4></div>
          <div><span>1. Acude a cualquier tienda afiliada </span></div>
          <div><span>2. Entrega al cajero el código de barras y menciona que </span></div>
          <div><span>realizarás un pago de servicio Paynet.</span></div>
          <div><span>3. Realizar el pago en efectivo por ${{$charge->amount}} MXN</span></div>
          <div><span>4. Conserva el ticket para cualquier aclaración..</span></div>
          <div><span>Si tienes dudas comunícate a Mercadata al teléfono </span></div>
          <div><span>612 122 5174 o al correo mercadata@acadep.com</span></div>
        </div>
    
        <div class="col-sm-6 col-md-6" id="otros">
            <div><h4>Instrucciones para el cajero</h4></div>
            <div><span>1. Ingresar al menú de Pago de Servicios.</span></div>
            <div><span>2. Seleccionar Paynet.</span></div>
            <div><span>3. Escanear el código de barras o ingresar el núm. de referencia.</span></div>
            <div><span>4. Ingresa la cantidad total a pagar.</span></div>
            <div><span>5. Cobrar al cliente el monto total más la comisión.</span></div>
            <div><span>6. Confirmar la transacción y entregar el ticket al cliente.</span></div>
        </div> 
      </div>
      <div class="col-sm-12 col-md-12">
          <img src="{{asset('/images/Openpay/Horizontal_1.gif')}}" width="100%" height="10%">
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