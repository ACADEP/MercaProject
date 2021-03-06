@extends('app')

@section('content')
<div class="col-md-12" id="body-cart">
<div id="loader-contener"></div>
<div class="row col-md-12">
    
    <div class="text-center col-12 col-sm-12 col-md-12 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-right-arrow">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
            </ol>
        </nav>  
    </div>
    

        <div class="row col-12 col-sm-12 col-md-12" style="display: inline-block; text-align: end;">
            
                <form class="form-inline" method="get" action="{{ route('cart.pdf') }}" style="display: inline-block;">
                    <input type="hidden" name="Items" id="items-carts">
                    <button class="btn btn-primary btn-xs btn-just-icon " formtarget="_blank" type="submit">
                            <i class="material-icons">local_printshop</i>
                    </button>
                </form>            
                
               
                <div id="btn-pay-div" style="display:inline;"> <a href="{{ route('pay-cart') }}" class="btn btn-success" id="btn-pay-cart">Pagar</a></div>  
               
                
        </div>

</div>
        

<table class="table text-center">
        <thead>
            <tr>
                <th></th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>SubTotal</th>
                <th>Eliminar</th>
            </tr>
        </thead>

        <tbody {{ Auth::check() ? 'id=client-body' : 'id=tbody' }}>
        
           @if(Auth::check())
                
                @foreach(Auth::user()->cart->with("product")->get() as $cart)
                    
                    <tr id="item-cart{{ $cart->id }}">
                       
                       <td style="width:100px;"><img style="width:100%;" src="{{ $cart->product->photos()->first()->path}}" alt=""></td>
                        <td> <a href="{{ route('show.product', $cart->product->id) }}">{{ $cart->product->product_name  }}</a></td>
                        
                        <td>${{ number_format(($cart->product_price), 2)  }}</td>
                        <td>
                            <select class="form-control selectCtd" id="{{ $cart->id }}">
                                @for($i = 0; $i < $cart->product->product_qty; $i++)
                                    <option value="{{$i+1}}">{{$i+1}}</option>
                                @endfor
                            </select>
                        </td>
                        <script>document.getElementById("{{ $cart->id }}").value = "{{ $cart->qty }}";</script>
                        <td id="total-client{{ $cart->id }}">${{number_format($cart->total, 2)}} 
                       
                        </td>
                        <input type="hidden" id="url" value="/cart/delete">
                        <td><button type='button' value="{{ $cart->id }}" class='btn btn-outline-danger btn-sm cart-delete'><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                @endforeach
                
           @endif
          
           
        </tbody>
        
    </table>
    @if(Auth::check())
       <div class="col-md-12 text-center" id="alert-cartP-A" style="font-size:25px;{{ Auth::user()->cart->count()==0 ? 'height:250px': '' }}"> @if(Auth::user()->cart->count()==0) No hay productos en este carrito @endif</div>
  
    @else
        <div class="col-md-12 text-center" id="alert-cartP" style="font-size:25px;"></div>
    @endif
    
<div class="text-right" {{ Auth::check() ? 'id=client-total' : 'id=general-total' }}>
    @if(Auth::check())
        El total de su carrito es: ${{ number_format(Auth::user()->total, 2)  }}
    @endif
</div>
                             
</div>
<style>
    #loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%;
        height: 100%;
        z-index: 9999;
        background: url('images/pageLoader.gif') 50% 50% no-repeat rgb(249,249,249);
        opacity: .8;
    }
</style>
<script>

    $("#btn-pay-cart").click(function(){
        $("#loader-contener").html("<div id='loader' class='text-center' style='font-size:40px; '><span style='padding-top:300px;'>Espere por favor</span> </div>");
    });

</script>
@stop
