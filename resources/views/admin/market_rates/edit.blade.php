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
        <div class="text-right">
            <button class="btn btn-success">Actualizar</button>
            <a href="{{route('show-marketRates')}}" class="btn btn-primary">Regresar</a>
            <button class="btn btn-info" type="button" data-toggle="modal" data-target="#add_product" >Agregar producto</button>&nbsp;
        </div>
        @include('admin.market_rates.includes.form-market', ["data"=>$marketrate])

    
</form>
</div>

<div class="col-md-8">
    <h4>Buscar</h4>
    <div class="col-md-12 ">
        <form action="{{route('searchedit-marketRates')}}" method="get">
            <input type="hidden" name="market" class="marketRate" value="{{$marketrate->id}}">
            <input type="text" class="form-control" placeholder="Buscar productos..." id="search" name="search" size="70">
            <button type="submit" class="btn btn-primary" style="vertical-align:top;">Buscar</button>
        </form>
    </div>
    <div class="col-md-12">
        @include('admin.market_rates.includes.search-results')
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
<div  id="productmarket_content">

</div>
</div><!--  fin del col-md-4 -->

@include('admin.market_rates.includes.modal-new')
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
   <script>
       //Establecer el tab activo
       $("#tab_active").val("product");
        $("#tab1").click(function(){
            $("#tab_active").val("product");
        });
        $("#tab2").click(function(){
            $("#tab_active").val("service");
        });

        $(".btn-add-newmarket").click(function(){
                var market_id=$(".marketRate").val(); 
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var productosCart=new Array();

                var validate=true;
                $(".msg-error").text("");
                if($("#tab_active").val()=="product")
                {
                    if($("#product_name").val()=="")
                    {
                        $("#product_name_error").text("Campo obligatorio");
                        validate=false;
                       
                    }
                    if($("#product_price").val()=="")
                    {
                        $("#product_price_error").text("Campo obligatorio");
                        validate=false;
                    }
                }

                if($("#tab_active").val()=="service")
                {
                    if($("#summary").val()=="")
                    {
                        $("#service_summary_error").text("Campo obligatorio");
                        validate=false;
                       
                    }
                    if($("#service_price").val()=="")
                    {
                        $("#service_price_error").text("Campo obligatorio");
                        validate=false;
                    }
                }

                if(!validate)
                {
                    return null;
                }
                
                $("#add_product").modal('toggle'); 
                var formData = $("#form-add-new").serialize()+"&market_id="+market_id;
                $.ajax({
                    url: "/admin/market_rates/addNewProduct",
                    method: 'POST',
                    data: formData,
                    success: function(response){

                        Cookies.set("market_id",response.market_id,1);
                        $(".marketRate").val(Cookies.get("market_id"));
                        console.log(response);

                        if(response.detail!=null)
                        {
                        
                            if(Cookies.get("products")!=null)
                            {
                                var productosJSON=jQuery.parseJSON(Cookies.get("products"));
                                productosCart=productosJSON;
                            }
                            productosCart.push(response.detail);
                            var cont=productosCart.length-1;
                            Cookies.set("products",productosCart,1);
                            if(cont==0)
                            {
                                $("#productmarket_content").empty();
                            }
                            $("#productmarket_content").append("<div class='col-md-12' id='product"+response.detail.id+"' style='margin-bottom:25px;'><div class='col-md-3'><img src='"+response.detail.thumbnail+"' style='width:100%;'></div>"+
                            "<div class='col-md-3'>"+String(response.detail.description).substring(0, 30)+"</div>"+
                            "<div class='col-md-3'> $"+parseFloat(response.detail.subtotal).toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")+"</div>"+
                            "<div class='col-md-3'> <button class='btn btn-danger btn-xs btn-delete-product' id='"+cont+"' value='"+response.detail.id+"'>Borrar</button> </div></div>");
                        }
                        else
                        {
                            $.notify({
                                // options
                                message: '<strong>Este Producto ya se encuentra en la cotización</strong>' 
                            },{
                                // settings
                                type: 'danger',
                                delay:3000
                            });
                        }
                        
                    
                    },

                    error: function(response){
                        console.log(response);
                        alert("Intente de nuevo");
                    }
            
                });
        });
   </script>
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