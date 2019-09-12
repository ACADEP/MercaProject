@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Nueva Cotización
        </h1> 
</section><br>

<div class="col-md-12 form-inline">
<form action="{{route('create-marketRate')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="marketRate" class="marketRate" value="">
    

    <div class="text-right">
       <button class="btn btn-success">Guardar</button>
       <a class="btn btn-default" id="btn-cancel">Cancelar</a><br><br>
       <div class="form-group ">
        <label for="company">Empresa:</label>
        <input type="text" class="form-control" maxlength="255" name="company" id="company" value="{{old('company')}}">
        &nbsp&nbsp
        <label for="email">Email:</label>
        <input type="email" class="form-control" maxlength="255" name="email" id="email" value="{{old('email')}}">
    </div>
    </div>
</form>
<br>
<div class="text-right">
<form style="display:inline;" action="{{route('sendEmail-MarketRate')}}" method="post" id="form-send">
    {{csrf_field()}}
    <input type="hidden" name="company" id="companySend">
    <input type="hidden" name="email" id="emailSend">
    <input type="hidden" name="markerate" class="marketRate">
    
    <button type="button" data-placement="top" title="Enviar al correo" class="btn btn-danger btn-sm " id="btn-send-market"><i class="fa fa-paper-plane-o"></i></button>
</form>
</div>

<div class="text-right">

</div>
</div>

<div class="col-md-8">
    <h4>Buscar</h4>
    <div class="col-md-12 ">
        <form action="{{route('search-marketRates')}}" method="get">
            <input type="text" class="form-control" placeholder="Buscar productos..." id="search" name="search" size="70">
            <button type="submit" class="btn btn-primary" style="vertical-align:top;">Buscar</button>
        </form>
    </div>
    <div class="col-md-12">
        @if(isset($search))
        <table class="table text-center">
        <thead>
            <tr>
                <th></th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($search as $product)
                <tr id="product{{$product->id}}">
                    <td class="col-md-2"><img src="{{$product->photos()->first()->path}}" style="width:50%;"></td>
                    <td>{{$product->product_sku}}</td>
                    <td>{{$product->product_name}}</td>
                    <td>${{number_format($product->real_price,2)}}</td>
                    <td>
                        <select class="form-control" id="qty_product{{$product->id}}">
                            @for($i=1;$i<=$product->product_qty;$i++)
                                <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    <td> 
                        @if ($product->product_qty > 0)
                            <button class="btn btn-primary btn-sm btn-add-market"  data-toggle="tooltip" title="Agregar" value="{{$product->id}}">
                                <i class="fa fa-plus"></i>
                            </button>
                        @else
                            <span class="label label-danger">Agotado</span>
                        @endif 
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
    {{ $search->appends(request()->except('page'))->links() }}
        @endif
    </div>
</div><!--  fin del col-md-8 -->

<div class="col-md-4">
<h4>Productos</h4>
<input type="hidden" name="marketRate" class="marketRate" value="">
    <div  id="productmarket_content">

    </div>
</div><!--  fin del col-md-4 -->
   
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
    </script>
@endif


@if ($errors->any())
    @foreach ($errors->all() as $error)
        <script> 
            $.notify({
                // options
                message: '<strong>{{ $error }}</strong>' 
            },{
                // settings
                type: 'danger',
                delay:5000
            });
        </script>
    @endforeach
@endif

@stop

@section("typehead-marketRates")
<style>
.team .row .col-md-4 {
    margin-bottom: 5em;
}
.team .row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
}
.team .row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}

.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {    /* used to be tt-dropdown-menu in older versions */
  width: 99%;
  margin-top: 4px;
  padding: 4px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
  padding: 3px 20px;
  line-height: 24px;
}

.tt-suggestion.tt-cursor,.tt-suggestion:hover {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}

.grow img
{
    transition: 1s ease;
}
    
.grow img:hover
{
    -webkit-transform: scale(1.2);
    -ms-transform: scale(1.2);
    transform: scale(1.2);
    transition: 1s ease;
}


        
</style>
   
    <script src="{{ asset('/js/typeahead.bundle.min.js') }}"></script>
    <script>
           
   
            $(function () {
            
            var datos = new Bloodhound({
                
              datumTokenizer: Bloodhound.tokenizers.whitespace,
              queryTokenizer: Bloodhound.tokenizers.whitespace,
            
             prefetch: {
                url: '/getData',
                ttl:0,
                cache: false,
            }
             
            }); 
            
            // inicializar typeahead sobre nuestro input de búsqueda
            $('#search').typeahead({
                hint: true,
                highlight: true,
                minLength: 1
            }, {
                name: 'datos',
                source: datos
            });
            
        });
    </script>
    <script>
    $("#btn-cancel").click(function(){
        if (confirm('Desea cancelar esta cotización')) {
            $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var market_id=Cookies.get("market_id");
        var formData = { market_id  : market_id};
        $.ajax({
            url: '/admin/market_rates/deleteMarket_rates',
            method: 'POST',
            data: formData,
            success: function(response){
                Cookies.remove("products");
                Cookies.remove("market_id");
                window.location.href = "{{route('show-marketRates')}}";
            

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