<li class="nav-item dropdown" >
                            
    <a class="nav-link hidden-md-down"  role="button" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons"> shopping_cart</i><span class="badge">{{ Auth::check() ? Auth::user()->cart->count() : '0' }}</span>
    </a>
    
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li>
            <div {{ Auth::check() ? 'id=client-container' : 'id=product_container' }} >
            @if(Auth::check())
                <script>borrarCache();</script>
                @php $tItems=0 @endphp
                @foreach(Auth::user()->cart->with('product')->get() as $cartItem)
                    @if($tItems<=4)
                            {{ $cartItem->product->product_name }}
                            <br>---------------------<br>
                    @endif
                    @php $tItems++ @endphp
                @endforeach
            @endif
            </div>
        </li>
                                           
        <li class="total">
            <span {{ Auth::check() ? 'id=total-items-client' : 'id=total-items' }}><strong>Total</strong>: ${{ Auth::check() ? number_format(Auth::user()->total, 2) : '0' }}</span>
            
            @if(Auth::check())
                @if(Auth::user()->carts()->count()>0)
                    <a href="{{ route('cart.payment') }}" class="btn btn-success btn-xs btn-pay">Pagar</a>
                @endif
            @endif
        </li>
        <li class="text-center">
            <a href="{{ route('cart') }}" id="cart-detail">Ir a detalles</a>      
        </li>
           
    </ul>
</li>
   

