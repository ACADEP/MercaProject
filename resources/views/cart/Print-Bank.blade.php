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
                <strong><h3 class="font">MercaData</h3></strong>
                Tu tienda de tecnologia en línea 
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
          <div><strong>Mercadata</strong></div>
          <div>Ignacio Allende,<br /> La Paz 23000, MX</div>
          <div>Tel: 612 122 5174</div>
          <div><a href="mailto:mercadata@acadep.com">mercadata@acadep.com</a></div>
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
      <h2 class="tittle font">Pasos para realizar el pago</h2>
      <div class="row" id="pago">
        <div class="col-sm-6 col-md-6" id="bancomer">
          <div><h4>Desde BBVA Bancomer</h4></div>
          <div><span>1. El cliente deberá ingresar a su banca en linea y </span></div>
          <div><span>dentro del menú "Pagar" seleccionar "De servicios".</span></div>
          <div><span>2. <strong>Número de convenio CIE: </strong>{{$charge->payment_method->agreement}}</span></div>
          <div><span>3. Ingrese los datos de registro para concluir con la</span></div>
          <div><span>operación.</span></div>
          <div><span><strong>Referencia: </strong>{{$charge->order_id}}</span></div>
          <div><span><strong>Importe: </strong>${{$charge->amount}} MXN</span></div>  
          <div><span><strong>Concepto: </strong>{{$charge->customer->name.' '.$charge->customer->last_name}}</span></div>
        </div>
    
        <div class="col-sm-6 col-md-6" id="otros">
            <div><h4>Desde cualquier otro banco</h4></div>
            <div><span>1. Ingresar a la sección de transferencias o pagos a terceros y</span></div>
            <div><span>proporcionar los datos de la transferencia, monto y concepto del pago.</span></div>
            <div><span><strong>Beneficiario: </strong>Mercadata</span></div>
            <div><span><strong>Banco destino: </strong>{{$charge->payment_method->bank}}</span></div>
            <div><span><strong>Clabe: </strong>{{$charge->payment_method->clabe}}</span></div>
            <div><span><strong>Concepto de pago: </strong>{{$charge->customer->name.' '.$charge->customer->last_name}}</span></div>
            <div><span><strong>Referencia: </strong>{{$charge->order_id}}</span></div>
            <div><span><strong>Importe: </strong>${{$charge->amount}} MXN</span></div>  
        </div>  
      </div>
    </main>
    <footer>
        <div class="row data">
            <div class="address">
                <span>Dirección: </span>
                <strong>La Paz, BCS México</strong>
            </div>
            <div class="phone">
                <span>Teléfono: </span>
                <strong>612 1225174</strong>
            </div>
        </div>
    </footer>
  </body>
</html>