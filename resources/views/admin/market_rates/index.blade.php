@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Cotizaciones
        </h1> 
</section><br>

<div class="col-md-12">
   
    <div class="text-left col-md-8 form-inline">
        <form action="{{route('searchMarketRates')}}" method="get">
            <input type="seacrh" class="form-control" placeholder="Buscar en cotizaciones" autocomplete="off" style="width:60%;" name="search" > 
            <button type="sumbit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

     <div class="text-right col-md-4 form-inline">
        <a type="button" href="{{route('create-marketRates')}}" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i> Nueva cotización</a>
    </div>
</div>

<table class="text-center table">
    <thead>
            <tr>
                <th>Fecha</th>
                <th>Correo</th>
                <th>Empresa</th>
                <th>Total</th>
                <th>PDF</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($market_rates as $marketrate)
        <tr id="rowMarket{{$marketrate->id}}">
            <td>{{ $marketrate->date }}</td>
            <td>{{ $marketrate->email }}</td>
            <td>{{ $marketrate->company }}</td>
            <td>${{number_format( $marketrate->total, 2) }}</td>
            <td>
                <form action="{{route('marketRatesPdf',$marketrate)}}" method="get">
                    <button type="submit" formtarget="_blank" data-placement="top" title="Generar PDF" class="btn btn-danger btn-xs"><i class="fa fa-file-pdf-o"></i></button>
                </form>
            </td>
            <td >
                <form style="display:inline;" action="{{route('edit-marketRates',$marketrate)}}" method="get">
                    <button type="submit" data-placement="top" title="Editar" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button>
                </form>
                <button class="btn btn-danger btn-xs btn-row-market" data-placement="top" title="Eliminar" value="{{$marketrate->id}}"><i class="fa fa-minus-square"></i></button>
                
                <form style="display:inline;" action="{{route('Send-MarketRate',$marketrate)}}" method="get">
                    <button type="submit" data-placement="top" title="Enviar al correo" class="btn btn-primary btn-xs btn-send-email"><i class="fa fa-paper-plane-o"></i></button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    
    </table>
   
   @if($market_rates->count()<=0)
    <div class="col-md-12 badge badge-primary">No hay resultados</div>
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
    
    </script>
@stop