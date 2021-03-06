<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cotización</title>
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
                <strong><h3>MercaData</h3></strong>
                Tu tienda de tecnologia en línea 
            </div>
      </div>
      <h1 class="tittle font">Cotización</h1>
      <div class="row mb-3" id="dates">
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
        {{-- <div><strong>Forma de pago: </strong></div>
        <div><strong>Tiempo de Entrega: </strong></div>
        <div><strong>¡Gracias por hacer su compra!</strong></div> --}}
        <div class="notice">El precio final puede variar de acuerdo a la forma de pago. No incluye fletes.</div>
        <div class="notice">A partir de 24 horas tiene 7 días para solicitar su factura al correo.</div>
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