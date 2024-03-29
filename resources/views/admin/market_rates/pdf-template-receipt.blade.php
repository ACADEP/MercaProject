<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Recibo de pago</title>
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
        
      }
      .box {
        float: left;
        width: 33.33%; /* three boxes (use 25% for four, and 50% for two, etc) */
        /* if you want space between the images */
      }

      .box-footer-table-left-1{
        background:black; 
        color:white !important; 
        width:50%; 
        height: 25px;
        display:inline-block;
       
      }

      .box-footer-table-left-2{
        width:50%; 
        display:inline-block;
        height: 25px;
        
      }

      .box-footer-table-right-1{
        background:black; 
        color:white !important; 
        width:33.33%; 
        height:25px; 
        display:inline-block;

      }

      .box-footer-table-right-2{
        width:66.66%; 
        display:inline-block;
        height: 25px;

      }

      hr {  display: block; height: 1px;
            border: 0; border-top: 1px solid black;}

    </style>
  </head>
  <body>
    {{-- Header 1 --}}
    <div class="text-center border-line" style="margin-bottom:10px; height:120px;">
        <div class="box">
            <img src="{{ asset('/images/logo_acadep.png')}}" style="width:70%; max-height:100px;">
        </div>

        <div class="box" style="font-size:10px !important;">
          <div><h3>Depósito a través de OXXO a cuenta BBVA Bancomer</h3></div>
          <div><span><strong>Propietario de la cuenta: </strong>Leonardo Lage Suarez</span></div>
          <div><span><strong>Cuenta: </strong>0136602037</span></div>
          <div><span><strong>Clabe: </strong>012040001366020373</span></div>
          <div><span><strong>Teléfono: </strong>612 122 5174</span></div>
          <div><span><strong>Correo: </strong><a href="mailto:administracion@acadep.com">administracion@acadep.com</a></span></div>
          <div><span><strong>Fecha límite de pago: </strong>{{Carbon\Carbon::now()->addDay(1)}}</span></div>
        </div>
        <div class="box">
            <div style="height: 120px; border-left:solid 1px black;">
              @php $current_date=\Carbon\Carbon::now(); @endphp
              {{$current_date->day}} de {{monthName($current_date->month)}} del {{$current_date->year}} <br>
              Recibo de pago
            </div>
            
        </div>
       
    </div>
    {{-- Fin header 1 --}}

    {{-- Header 2 --}}
    <div class="border-line" style="height: 100px; font-size:12px !important;">
        <div style="float: left; width:66.66%;">
            <span><strong>Cotización</strong></span> {{ $items->id}}  <br> 
            <strong>Cliente:</strong> {{$items->customer->full_name}}<br> 
            <strong>Contacto:</strong> {{$items->contact}}<br>
            <strong>Domicilio:</strong> {{$items->address}}<br>
            <strong>Telefono:</strong> {{$items->customer->telefono}}<br>

        </div>

        <div style="float: left; width:33.33%; font-size:10px !important;">
            <div class="text-center"  style="height: 50px; border-left:solid 1px black; border-bottom:solid 1px black;"">
                <strong>TIEMPO DE ENTREGA:</strong> <br>
                5 días hábiles después del finiquito 
            </div>

            <div class="text-center" style="height: 50px; border-left:solid 1px black;"">
                <strong>CONDICIONES DE PAGO: </strong> <br>
                100% a la orden

            </div>
           
        </div>
    </div>
    {{-- Fin header 2 --}}

    {{-- Mensaje intermedio --}}
    <div class="text-center" style="padding: 8px;">
     
    </div>
    {{-- Fin del mensaje intermedio --}}

    {{-- Tabla de productos --}}
    <table id="main-table">
      <thead style="background:black; color:white !important;">
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
        @foreach($items->MarketRatesDetails()->get() as $item)
          <tr>
              <td class="text-center">{{$loop->iteration}}</td>
              <td class="desc">{{$item->product_sku}}</td>
              <td class="unit">{{ substr($item->description,0,30) }}</td>
              <td class="service">{{$item->qty}}</td>
              <td class="service">{{$item->unity}}</td>
              <td class="qty">${{number_format($item->price, 2)}}</td>
              <td class="total">${{number_format(($item->subtotal), 2)}}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
    {{-- Fin de la tabla --}}

     {{-- Tabla footer --}}
     <div class="border-line" style="height: 100px; font-size:12px !important;">
      
      <div style="float: left; width:66.66%; padding-top:5px;">
        <div style="width:100%; height:25px;" >
          <div class="box-footer-table-right-1">
           Vigencia: 
          </div>

          <div class="box-footer-table-right-2">
            5 días habiles
            
          </div>

        </div>

        <div  style="width:100%; height:25px;" >
          <div class="box-footer-table-right-1" >
           Notas: 
          </div>

          <div class="box-footer-table-right-2" style="font-size:8px !important;">
            1.- Esta cotización está sujeta a número de piezas en existencia y/o vigencia de promoción.
           
          </div>

        </div> 

        <div  style="width:100%; height:25px;" >
          <div class="box-footer-table-right-1">
          
          </div>

          <div  class="box-footer-table-right-2" style="font-size:8px !important;">
            2.- Esta cotización está sujeta a cambio de precio.
           
          </div>

        </div>   

        <div style="width:100%; height:25px;" >
          <div  class="box-footer-table-right-1">
          
          </div>

          <div  class="box-footer-table-right-2" style="font-size:8px !important;">
            3.-Lo que no se especifica en esta cotización tiene un costo adicional.
           
          </div>

        </div>        

      </div>

      <div style="float: left; width:33.33%; font-size:10px !important; padding-top:5px;">
          
          <div style="width:100%; height:25px;" >
            <div  class="box-footer-table-left-1" >
              Moneda: 
            </div>
  
            <div class="box-footer-table-left-2" >
              PESOS MXN
             
            </div>

          </div>

          <div style="width:100%; height:25px;" >
            <div  class="box-footer-table-left-1">
              Subtotal: 
            </div>
  
            <div class="box-footer-table-left-2">
              ${{number_format($items->total, 2) }}
             
            </div>

          </div>

          <div style="width:100%; height:25px;" >
            <div  class="box-footer-table-left-1">
              I.V.A 16%: 
            </div>
  
            <div class="box-footer-table-left-2">
             ${{number_format($items->total * 0.16, 2)}}
             
            </div>

          </div>

          <div style="width:100%; height:25px;" >
            <div  class="box-footer-table-left-1">
              Total: 
            </div>
  
            <div class="box-footer-table-left-2">
              ${{number_format($items->total_with_iva, 2) }}
             
            </div>

          </div>   
         
      </div>
  </div>
  {{-- Fin tabla footer --}}

   {{-- footer info 1 --}}
   <div class="text-center border-line" style="margin-top:10px; height:50px; font-size:8px !important;">
    <div class="text-center">
        @php 
        $f = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $entero=(int)$items->total_with_iva;
        $entero_text=$f->format($entero);
        $decimals=round($items->total_with_iva, 2)-$entero;
        $texto="( ".$entero_text." Pesos ".explode(".", number_format($decimals, 2))[1]."/100)";
        
      @endphp
      Son: {{ucwords($texto)}}
    </div>

    <div  style="font-size:10px !important; background:black; color:white;">
      CUENTAS BANCARIAS PARA PAGOS Y TRASFERENCIAS
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
   
</div>
{{-- fin footer info 1 --}}

{{-- footer info 2 --}}

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

{{-- fin footer info 2 --}}



  </body>
</html>

{{-- Funcion para obtener el nombre del mes  --}}
@php
function monthName($num_month)
{
        $name="";
        switch($num_month)
        {
            case "1":
            {
                $name="Enero";
                break;
            }
            case "2":
            {
                $name="Febrero";
                break;
            }
            case "3":
            {
                $name="Marzo";
                break;
            }
            case "4":
            {
                $name="Abril";
                break;
            }
            case "5":
            {
                $name="Mayo";
                break;
            }
            case "6":
            {
                $name="Junio";
                break;
            }
            case "7":
            {
                $name="Julio";
                break;
            }
            case "8":
            {
                $name="Agosto";
                break;
            }
            case "9":
            {
                $name="Septiembre";
                break;
            }
            case "10":
            {
                $name="Octubre";
                break;
            }
            case "11":
            {
                $name="Noviembre";
                break;
            }
            case "12":
            {
                $name="Diciembre";
                break;
            }

        }
       
        return $name;  
}    
@endphp