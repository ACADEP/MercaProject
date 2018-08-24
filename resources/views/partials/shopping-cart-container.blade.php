<li class="nav-item dropdown" >
                            
    <a class="nav-link hidden-md-down"  role="button" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons"> shopping_cart</i><span class="badge">{{ Auth::check() ? Auth::user()->carts->count() : '0' }}</span>
    </a>
    
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li>
            <div {{ Auth::check() ? 'id=client-container' : 'id=product_container' }} >
            @if(Auth::check())
                <script>borrarCache();</script>
                @foreach(Auth::user()->carts as $cartItem)
                    {{ Auth::user()->product($cartItem->product_id)->product_name }}
                    <br>---------------------<br>
                @endforeach
            @endif
            </div>
        </li>
                                           
        <li class="total">
            <span><strong>Total</strong>: $0.00</span>
            @if(Auth::check())
                <button class="btn btn-success btn-xs btn-pay">Pagar</button>
            @endif
        </li>
        <li class="text-center">
            <a href="{{ route('cart') }}">Ir a detalles</a>      
        </li>
           
    </ul>
</li>
   

