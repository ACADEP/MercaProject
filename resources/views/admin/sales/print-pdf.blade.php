<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Historial de ventas</title>
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
      <h1 class="tittle font">Historial de ventas</h1>

      <div class="row mb-3" id="dates">
        <div class="col-sm-6 col-md-6" id="project">
          <div><span><strong>Usuario</strong></span> {{ Auth::check() ? Auth::user()->username : 'visitante' }}</div>
          <div><span><strong>Correo</strong></span>{{ Auth::check() ? Auth::user()->email : 'visitante' }}</div>
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
    @php $totalSale=0;@endphp
    <table class="table text-center">
    <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre del producto</th>
                <th>Precio unt</th>
                <th>Cliente</th>
                <th>Fecha de la venta</th>
                <th>Cantidad</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
      
            @foreach($seleHistories as $history)
                <tr>
                    <td ><img  src="{{url( $history->product->photos->first()->path)}}"  height="30px"></td>
                    <td>{{ $history->product->product_name }}</td>
                    <td>${{number_format($history->product->price, 2)}}</td>
                    <td>{{ $history->client }}</td>
                   
                    <td>{{ $history->date}}</td>
                    <td>{{ $history->amount }}</td>
                    <td>${{number_format($history->total, 2)  }}</td>
                    @php $totalSale+=$history->total; @endphp
                </tr>
            @endforeach
       
        </tbody>
    
    </table>
    <div class="text-right">
           <strong>Total:</strong>  ${{number_format($totalSale, 2) }}
    </div>
        <div class="notice">{{config('configurations.mk.information_final_2')}}</div>
        <div class="notice">{{config('configurations.mk.information_final')}}</div>
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