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
      <h1 class="tittle">Recibo de Pago</h1>
      <div id="company" class="clearfix">
        <div><strong>Mercadata</strong></div>
        <div>Ignacio Allende,<br /> La Paz 23000, MX</div>
        <div>Tel: 612 122 5174</div>
        <div><a href="mailto:mercadata@acadep.com">mercadata@acadep.com</a></div>
      </div>

      <div id="project">
        <div><span><strong>Cliente</strong></span> {{Auth::User()->customer->telefono}}</div>
        <div><span><strong>Dirección</strong></span> {{$address->calle}}, {{$address->ciudad}} {{$address->cp}}, {{$address->estado}}</div>
        <div><span><strong>Correo</strong></span> <a href="mailto:{{Auth::User()->email}}">{{Auth::User()->email}}</a></div>
        <div><span><strong>Fecha</strong></span> {{ $now->format('d-m-Y') }}</div>
        <div><span><strong>Expiración</strong></span> {{$expiry}}</div>
      </div>

      <div class="bank">
        <div><h3>Depósito a través de OXXO a cuenta BBVA Bancomer</h3></div>
        <div><span><strong>Propietario de la cuenta: </strong>Leonardo Lage Suarez</span></div>
        <div><span><strong>Cuenta: </strong>0136602037</span></div>
        <div><span><strong>Clave: </strong>012040001366020373</span></div>
        <div><span><strong>Teléfono: </strong>612 122 5174</span></div>
        <div><span><strong>Correo: </strong><a href="mailto:administracion@acadep.com">administracion@acadep.com</a></span></div>
        <div><span><strong>Fecha límite de pago: </strong>{{$expiry}}</span></div>
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
          @foreach($cartItems as $item)
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
            <td class="total">${{number_format($subtotal, 2) }}</td>
          </tr>
          <tr>
            <td colspan="4">IVA</td>
            <td class="total">$ 00.00</td>
          </tr>
          <tr>
            <td colspan="4">Costo de envío</td>
            <td class="total">$ 00.00</td>
          </tr>    
          <tr>
            <td colspan="4" class="grand total">Total</td>
            <td class="grand total">${{number_format($subtotal, 2) }}</td>
          </tr>
        </tbody>
      </table>
      <div id="notices">
        <div><strong>Forma de pago: </strong></div>
        <div><strong>Tiempo de Entrega: </strong></div>
        <div><strong>¡Gracias por hacer su compra!</strong></div>
        <div class="notice">* Precios sujetos a cambio sin precio aviso.</div>
        <div class="notice">En espera de vernos favorecidos con su pedido, nos ponemos a sus ordenes para cualquier aclaración.</div>
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