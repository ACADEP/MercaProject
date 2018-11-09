@extends('app')

@section('content')
<div class="col-md-12" id="body-cart">

<div class="row col-md-12">
    @if(Auth::check()==false)
        <div class="alert alert-primary lert-dismissible fade show mt-3" role="alert">
            Inicie sesión o Regístrese para completar su compra.
            <button type="button" class="close ml-3" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="text-center col-12 col-sm-12 col-md-12 pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-right-arrow">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active" aria-current="page">Carrito</li>
            </ol>
        </nav>  
    </div>
    <div class="col-sm-12 col-md-12">
        <form class="form-inline text-right"  method="get" action="{{ route('cart.pdf') }}">
            <div class="text-right" style="width:100%;">
                <input type="hidden" name="Items" id="items-carts">
                <button class="btn btn-primary btn-just-icon" formtarget="_blank" type="submit">
                        <i class="material-icons">local_printshop</i>
                </button>
                @if(Auth::check())
                    @if(Auth::user()->carts()->count()>0)
                        <div id="btn-pay-div" style="display:inline;"> <a href="{{ route('pay-cart') }}" class="btn btn-warning btn-md text-center" style="font-size: 14px;">Pagar Todo</a></div>  
                    @endif
                @endif
            </div>
        </form>            
    </div>
</div>
        

<table class="table text-center">
        <thead>
            <tr>
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
                       
                        <td> <a class="link-products" href="{{ route('show.product', $cart->product->product_name) }}">{{ $cart->product->product_name  }}</a></td>
                    
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
<div class="text-right" {{ Auth::check() ? 'id=client-total' : 'id=general-total' }}>
    @if(Auth::check())
        El total de su carrito es: ${{ number_format(Auth::user()->total, 2)  }}
    @endif
</div>
                        
   
    
    
   
        
</div>
@stop
