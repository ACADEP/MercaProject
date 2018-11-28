@extends('customer.dash')

@section('content')
<section class="content-header">
        <h1>
           Mis productos favoritos
        </h1>
</section><br>
@if($favorites->count() > 0)
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
@php $i=1;@endphp
<div class="panel panel-default">
@foreach($favorites as $favorite)
   
    <div class="panel-heading" role="tab" id="heading{{$i}}" style="background-color:rgb(204, 204, 204); border: solid 1px;">
      <h4 class="panel-title">
        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$i}}" aria-expanded="true" aria-controls="collapse{{$i}}">
          <span class="label label-primary" style="font-size:15px;">{{$favorite->product->product_name}}</span> 
        </a>
      </h4>
    </div>
    <div id="collapse{{$i}}" class="{{ $i==1 ? 'panel-collapse collapse in' : 'panel-collapse collapse' }}" role="tabpanel" aria-labelledby="heading{{$i}}">
      <div class="panel-body">
        <div class="text-left" >
           
        </div>
        <div class="text-right">
        <form action="{{ route('delete-favorite') }}" method="post" style="display:inline;">
            {{ csrf_field() }}
            <input type="hidden" name="favorite" value="{{ $favorite->id }}">
            <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
        </form>
            <button class="btn btn-primary btn-sm btn-addcart" value="{{$favorite->product->id}}" data-toggle="tooltip" title="Agregar al carrito" >
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </button>
            <input type="hidden" id="product_id{{$favorite->product->id}}" value="{{$favorite->product->id}}"/>
            <input type="hidden" id="qty" value="1"/>
            <input type="hidden" id="url" value="/cart/add">
        </div>
            
            <table class="table text-center" style="font-size:17px;">
            <thead>
                    <tr>
                        <th class="text-center" style="width:10%;"></th>
                        <th>Producto</th>
                        <th>Description</th>

                    </tr>
            </thead>
            <tbody>
               
                    <tr>
                        <td ><img class="img-responsive" src="{{$favorite->product->photos()->first()->path}}" style="height:75px;"></td>
                        <td> <br>  <a class="link-products" href="{{ route('show.product', $favorite->product->product_name) }}" > {{$favorite->product->product_name}}</a></td>
                        <td> <br> {{$favorite->product->description}}</td>
                    </tr>
                
            </tbody>
            
            </table>

           </div>

<!-- Fin panel body--></div> 
@php $i++;@endphp
@endforeach
 <!--Fin collapse-->   </div>
 <div class="text-center" style="position: absolute; bottom: 15px;">
                {{ $favorites->links() }}
            </div> 
 @else
<div class="col-md-12 alert alert-warning" style="font-size:15px;">No hay productos favoritos</div>
 @endif
  

@stop

@section('msg')
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
 
@stop