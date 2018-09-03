@extends('app')

@section('content')
<div class="col-md-12" id="body-cart">

<form class="form-inline text-center"  method="get" action="{{ route('cart.pdf') }}">
                <div class="text-right" style="width:100%;">
                    <input type="hidden" name="Items" id="items-carts">
                    <button class="btn btn-primary btn-just-icon" formtarget="_blank" type="submit">
                    <button class="btn btn-primary btn-just-icon" target="_blank" type="submit">
                            <i class="material-icons">local_printshop</i>
                    </button>
                    @if(Auth::check())
                        <button type="button" class="btn btn-success text-center">Pagar</button>
                    @endif
                </div>
                
</form>
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
                       
                        <td> <a href="{{ route('show.product', $cart->product->product_name) }}">{{ $cart->product->product_name  }}</a></td>
                    
                        <td>${{ number_format(($cart->product_price), 2)  }}</td>
                        <td>
                            <select class="form-control selectCtd" id="{{ $cart->id }}">
                                @for($i = 0; $i < $cart->product->product_qty; $i++)
                                    <option value="{{$i+1}}">{{$i+1}}</option>
                                @endfor
                            </select>
                        </td>
                        <script>document.getElementById("{{ $cart->id }}").value = "{{ $cart->qty }}";</script>
                        <td id="total-client{{ $cart->id }}">${{number_format($cart->total, 2)}}</td>
                        <input type="hidden" id="url" value="{{ route('deleteCart')}}">
                        <td><button type='button' value="{{ $cart->id }}" class='btn btn-outline-danger btn-sm cart-delete'><i class="fa fa-trash" aria-hidden="true"></i></button></td>
                    </tr>
                @endforeach
           @endif
          
           
        </tbody>
        
    </table>
    
    <div class="text-center" {{ Auth::check() ? 'id=client-total' : 'id=general-total' }}>
            @if(Auth::check())
                El total de su carrito es: ${{ number_format(Auth::user()->total, 2)  }}
            @endif
    </div>
    
    
   
        
</div>
@stop
