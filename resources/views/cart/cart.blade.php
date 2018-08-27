@extends('app')

@section('content')
<div class="col-md-12" style="height:100%; widht=100%;">
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>SubTotal</th>
                <th>Opciones</th>
            </tr>
        </thead>

        <tbody {{ Auth::check() ? 'id=client-body' : 'id=tbody' }}>
        
           @if(Auth::check())
                
                @foreach(Auth::user()->carts as $cart)
                    
                    <tr id="item-cart{{ $cart->id }}">
                        <td>{{ Auth::user()->product($cart->product_id)->product_name  }}</td>
                        <td>{{ Auth::user()->product($cart->product_id)->price  }}</td>
                        <td>
                            <select class="form-control selectCtd" id="{{ $cart->id }}">
                                @for($i = 0; $i < Auth::user()->product($cart->product_id)->product_qty; $i++)
                                    <option value="{{$i+1}}">{{$i+1}}</option>
                                @endfor
                            </select>
                        </td>
                        <td id="total-client{{ $cart->id }}">{{ $cart->total }}</td>
                        <input type="hidden" id="url" value="{{ route('deleteCart')}}">
                        <td><button type='button' value="{{ $cart->id }}" class='btn btn-outline-danger btn-sm cart-delete'>Borrar</button></td>
                    </tr>
                @endforeach
           @endif
          
           
        </tbody>
        
    </table>
    <form class="form-inline" method="get" action="{{ route('cart.pdf') }}">
        <input type="hidden" name="Items" id="items-carts">
            <button class="btn btn-primary btn-just-icon" type="submit">
                    <i class="material-icons">local_printshop</i> Imprimir PDF
            </button>
    </form>
    
    @if(Auth::check())
        <button type="button" class="btn btn-success text-center"><i class="material-icons">attach_money</i> Pagar</button>
    @endif
        
</div>
@stop
