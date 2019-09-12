@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Editar Cotizaciones
        </h1> 
</section><br>

<div class="col-md-12 form-inline">
<form action="{{route('update-marketRate')}}" method="post">
    {{csrf_field()}}
    <input type="hidden" name="marketRate" class="marketRate" value="{{$marketrate->id}}">
    <div class="form-group col-md-4">
        <label for="company">Empresa:</label>
        <input type="text" class="form-control" maxlength="255" name="company" id="company" value="{{old('company',$marketrate->company)}}">
        
    </div>

    <div class="form-group col-md-3">
        <label for="email">Email:</label>
        <input type="email" class="form-control" maxlength="255" name="email" id="email" value="{{old('email', $marketrate->email)}}">
    </div>

    <div class="text-right">
       <button class="btn btn-success">Actualizar</button>
       <a href="{{route('show-marketRates')}}" class="btn btn-primary">Regresar</a>
    </div>
</form>
</div>

<div class="col-md-8">
    <h4>Buscar</h4>
    <div class="col-md-12 ">
        <form action="{{route('searchedit-marketRates')}}" method="get">
            <input type="hidden" name="market" value="{{$marketrate->id}}">
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
                    <td>${{ number_format($product->real_price,2)}}</td>
                    <td>
                        <select class="form-control" id="qty_product{{$product->id}}">
                            @for($i=1;$i<$product->product_qty;$i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                        </select>
                    </td>
                    <td>
                        <form action="{{route('add-marketRatesEdit')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="market_id" value="{{$marketrate->id}}">
                            <input type="hidden" name="product_id"  value="{{$product->id}}">
                            <input type="hidden" name="qty" id="product_ma{{$product->id}}">
                            <script>document.getElementById("product_ma{{$product->id}}").value=document.getElementById("qty_product{{$product->id}}").value;</script>
                            <button class="btn btn-primary btn-sm" type="submit" data-toggle="tooltip" title="Agregar" value="{{$product->id}}">
                                <i class="fa fa-plus"></i>
                            </button>
                        </form>
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

@foreach($marketrate->MarketRatesDetails()->get() as $detail)
<div class='col-md-12' style='margin-bottom:25px;' id="rowProduct{{$detail->id}}"><div class='col-md-3'><img src="{{$detail->thumbnail}}" style='width:100%;'></div>
<div class='col-md-3'>{{ substr($detail->description, 0, 30) }}..</div>
<div class='col-md-3'>${{ number_format($detail->subtotal,2)}}</div>
<div class='col-md-3'>
    <button  class='btn btn-danger btn-xs btn-row-product' value="{{$detail->id}}">Borrar</button></form> 
</div></div>
@endforeach

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

@if(Session::has('alert'))
<script> 
    $.notify({
        // options
        message: '<strong>{{ Session("alert") }}</strong>' 
    },{
        // settings
        type: 'danger',
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
@stop