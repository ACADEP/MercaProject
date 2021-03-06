@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Cotizaciones
        </h1> 
</section><br>

<div class="row">
   
    <div class="text-left col-md-4 col-xl-4 col-xs-4">
        <form action="{{route('searchMarketRates')}}" method="get">
            <input type="seacrh" class="form-control" placeholder="Buscar en cotizaciones" autocomplete="off"  name="search" 
            value="@isset($old_inputs){{$old_inputs["search"]}}@endisset"> 
            
           
        </form>
    </div>

    <div class="col-md-4 col-xl-4 col-xs-4">
        <select class="form-control" name="client" id="">
            <option value="">Buscar por cliente</option>
            @foreach ($clients as  $client)
                <option 
                @isset($old_inputs)
                    @if($old_inputs["client"]==$client->id)
                        selected
                    @endif
                @endisset
                value="{{$client->id}}">{{$client->full_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-2 col-xl-2 col-xs-2">
        <button type="sumbit" class="btn btn-primary">Buscar</button>
    </div>

     <div class="col-md-2 col-xl-2 col-xs-2 ">
        <a type="button" href="{{route('create-marketRates')}}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i></a>
    </div>
</div>

<table class="text-center table">
    <thead>
            <tr>
                <th>Num. Cotización</th>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>PDF</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($market_rates as $marketrate)
        <tr id="rowMarket{{$marketrate->id}}">
            <td>{{ $marketrate->id}}</td>
            <td>{{ $marketrate->date ? $marketrate->date->format("d/m/Y") : "No agregado" }}</td>
            <td>{{ $marketrate->email }}</td>
            <td>{{ $marketrate->customer ? $marketrate->customer->full_name : "No asignado"}}</td>
            <td>${{number_format( $marketrate->total_with_iva, 2) }}</td>
            <td>
               
                <form action="{{route('marketRatesPdf',$marketrate)}}" method="get">
                    <button type="submit" formtarget="_blank" data-placement="top" title="Generar PDF" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></button>
                </form>
               
            </td>
            <td class="row">
               
                
                <a role="button" href="{{route('edit-marketRates',$marketrate->id)}}" data-placement="top" title="Editar" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
            
                @can("delete_markerRate")
                <button class="btn btn-danger btn-xs btn-row-market" data-placement="top" title="Eliminar" value="{{$marketrate->id}}"><i class="fa fa-minus-square"></i></button>
                @endcan
                    <a role="button" href="{{route('Send-MarketRate',$marketrate)}}" data-placement="top" title="Enviar al correo" class="btn btn-primary btn-xs btn-send-email"><i class="fa fa-paper-plane-o"></i></a>
                @can("pay_markerRate")
                <form style="display:inline;" action="{{route('addOrder')}}" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="marketrate" value="{{$marketrate->id}}">
                    <button type="submit"  data-placement="top" title="Convertir a pedido" class="btn btn-primary btn-xs"><i class="fa fa-cart-arrow-down"></i></button>
                </form>
                @endcan
            </td>
        </tr>
        @endforeach
        </tbody>
    
    </table>
   
   @if($market_rates->count()<=0)
    <div class="col-md-12 badge badge-primary">No hay cotizaciones</div>
   @endif
    

@stop

@section("msg-success")
@if(Session::has('success'))
    <script> 
        $.notify({
            // options
            message: '<strong>{{ Session("success") }}</strong>' 
        },{
            // settings
            type: 'success',
            delay:5000
        });
        Cookies.remove("products");
        Cookies.remove("market_id");
    </script>
@endif
@if(Session::has('email-sended'))
    <script> 
        $.notify({
            // options
            message: '<strong>{{ Session("email-sended") }}</strong>' 
        },{
            // settings
            type: 'success',
            delay:4000
        });
        Cookies.remove("products");
        Cookies.remove("market_id");
    </script>
@endif
@if(Session::has('fail'))
    <script> 
            $.notify({
                // options
                message: '<strong>{{ Session("fail") }}</strong>' 
            },{
                // settings
                type: 'danger',
                delay:5000
            });
            Cookies.remove("products");
            Cookies.remove("market_id");
    </script>
@endif
@if(Session::has('pay-marketrate'))
    <script>
       $.notify({
                // options
                message: '<strong>La cotización paso a ordenes realizar el pago en el proximo día</strong>' 
            },{
                // settings
                type: 'success',
                delay:7000
            });
        window.open('/admin/market_rates/showPDF', '_blank');
    </script>
@endif
    <script>
        $(".btn-send-email").click(function(){
            $.notify({
                // options
                message: '<strong>Enviando correo espere por favor</strong>' 
            },{
                // settings
                type: 'warning',
                delay:4000
            });
        });

        //Elimnar la cotizacion 
        $(".btn-row-market").click(function(){
        if (confirm('Seguro que quiere eliminar esta cotización')) {
            $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var market_id=$(this).val();

            var formData = { market_id:market_id};
            $.ajax({
                url: "/admin/market_rates/deleteMarket_rates",
                method: 'POST',
                data: formData,
                success: function(response){
                $("#rowMarket" + market_id).remove();
                $.notify({
                    // options
                    message: '<strong>'+response+'</strong>' 
                },{
                    // settings
                    type: 'success',
                    delay:3000
                });
            
                
            
            },

            error: function(response){
                console.log(response);
                alert("Intente de nuevo");
            }

            });
            }else{}
        });
    </script>

@stop

@section('modal-add')
<div class="modal fade" id="choose_carrie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Elegir metodo de envío</h1>
      </div>
      <div class="modal-body row">
    
      </div>
    </div>
  </div>
</div>
@stop