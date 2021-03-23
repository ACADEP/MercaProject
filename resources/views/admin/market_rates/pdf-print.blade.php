<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Cotización</title>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/InvoicePayment.css') }}" media="all" />
    <style>
      #table-header {
        border-collapse: collapse;
      }

      .border-line {
        border: 1px solid black;
      }

      #main-table tr td{
        font-size: 10px !important;
      }
      #main-table th{
        font-size: 11px !important;
      }
      body {
        font-family:  Arial !important;
        font-size: 13px;
      }
    </style>
  </head>
  <body>
    @php  $now = new \DateTime(); @endphp
    <header class="clearfix">
      <div id="logo" style="margin-bottom:30px;">
          <div class="mercaLogo">
            <img src="{{asset(config('configurations.general.main_logo'))}}">
          </div>
            <div class="slogan font">
                <strong><h3>{{config('configurations.general.store_name')}}</h3></strong>
                {{config('configurations.mk.slogan')}}
            </div>
      </div>
      

      <div class="row mb-3 " id="dates">
        <div class="col-sm-4 text-left" style="font-size:30px !important; padding:5px !important;" >
          
            Cotización {{$items->id}}

          
        </div>
         
        <div class="col-sm-6 col-md-6 text-right" id="company" class="clearfix font">
          <div><strong>German Leonardo Lage Suarez </strong></div>
          <div>LASG 730203 7D4<br /> 
            Allende Entre Revolución y Serdán #270 {{config('configurations.company.postal_code')}}, 
                {{config('configurations.company.country_code')}}</div>
          <div>Tel: (612) 122 5174 / Cel:(612) 111 7386</div>
          <div><a href="mailto:mercadata@acadep.com">mercadata@acadep.com</a></div>
        </div>  
      </div>

      <div class="row mt-5"></div>
    </header>

    <div class="row" style="margin-bottom:20px;">

      <div class="col-sm-7 col-md-7" style="width:100%" id="project">
       
        <div ><span><strong>Cliente</strong></span> {{ $items->company }}</div>
        <div ><span><strong>Correo</strong></span>{{ $items->email }}</div>
        <div ><span><strong>Fecha</strong></span> {{ $now->format('d-m-Y') }}</div>
      </div>

      <div class="col-sm-4 col-md-4 text-right" id="company">
        
        <div style="width:100%">
          <strong>Tiempo de entrega</strong><br>
          Inmediata <br>
        </div>
  
        <div style="width:100%">
          <strong>Condiciones de pago</strong><br>
          100% a la orden
        </div>
        
      </div>
    </div>
    

    <main>
      <table id="main-table">
        <thead>
          <tr>
            <th>#</th>
            <th class="desc"><strong>Código</strong></th>
            <th><strong>Descripción</strong></th>
            <th class="service"><strong>Cantidad</strong></th>
            <th><strong>Unidad</strong></th>
            <th><strong>Precio</strong></th>
            <th><strong>Total</strong></th>
          </tr>
        </thead>
        <tbody>
          @php 
            $total=0;

          @endphp
          @foreach($items->MarketRatesDetails()->get() as $item)
            @php 
              $total+=($item->price*$item->qty);

            @endphp
            <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td class="desc">{{$item->product_sku}}</td>
                <td class="unit">{{ $item->description }}</td>
                <td class="service">{{$item->qty}}</td>
                <td class="service">{{$item->unity}}</td>
                <td class="qty">${{number_format($item->price, 2)}}</td>
                <td class="total">${{number_format(($item->subtotal), 2)}}</td>
            </tr>
          @endforeach
          <tr>
           
            <td colspan="6"><strong>Moneda</strong></td>
            <td class="total">Pesos MXN</td>
          </tr>
          <tr>
            <td colspan="6">Subtotal</td>
            <td class="total">${{number_format($total, 2) }}</td>
          </tr>
          <tr>
            <td colspan="6">IVA</td>
            <td class="total">Incluido</td>
          </tr>
          <tr>
            <td colspan="6">Costo de envío</td>
            <td class="total">En sitio</td>
          </tr>    
          <tr>
            <td colspan="6" class="grand total">Total</td>
            <td class="grand total">${{number_format($total*1.16, 2) }}</td>
          </tr>
         
        </tbody>
      </table>
      <div class="border-line">
        <strong>Vigencia: </strong> 5 días habiles
      </div>
    
      <div class="border-line">
        <strong>Notas: </strong> <br>
          1. Esta cotización esta sujeta a número de piezas y/o vigencia de promoción <br>
          2. Esta cotización esta sujeta a cambio de precio <br>
          3. Lo que no se especifica en esta cotizacion tiene un costo adicional
      </div>

      <div class="border-line text-center">
        @php 
          $f = new NumberFormatter("es", NumberFormatter::SPELLOUT);
          $entero=(int)$total*1.16;
          $entero_text=$f->format($entero);
          $decimals=round($total*1.16, 2)-$entero;
          $texto="( ".$entero_text." Pesos ".explode(".", number_format($decimals, 2))[1]."/100)";
          
        @endphp
        Son: {{ucwords($texto)}}
      </div>

      <div class=" text-center">
        <strong> Cuentas bancarias para pagos y transferencias</strong>
      </div>

      <div class="text-center row">
        <div class="col-sm-4 col-md-4 text-right" id="company">
          <strong>CLABE</strong> 036040500473861193
        </div>
        <div class="col-sm-4 col-md-4 text-right" id="company">
          <strong>Cuenta</strong> 50047386119
        </div>
        <div class="col-sm-4 col-md-4 text-right" id="company">
          <strong>Banco</strong> Inbursa
        </div>
      </div>
    

      <div class="row text-center">
        LA PAZ - LOS CABOS BCS - CDMX
      </div>

      <div  style="text-align: justify; text-justify: inter-word; font-size:10px !important;">
        (*) Los conceptos, equipos, procesos, servicios, asistencia técnica y cotizaciones señaladas en el 
        presente documento son de carácter confidencial ya que representan un secreto industrial, 
        por lo que no podrán ser difundidos por ningún medio por su receptor sin el consentimiento 
        expreso y por escrito, así como no podrán ser utilizados como base para la celebración de 
        cotizaciones con empresas distintas a la antes señalada, so pena de incurrir en 
        las responsabilidades civiles y penales que señalan los artículos 82a86 bis-1 de la 
        Ley de Propiedad Industrial y el Código Penal aplicable. 
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