<li class="nav-item dropdown" >
                            
    <a class="nav-link hidden-md-down"  role="button" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons"> shopping_cart</i><span class="badge">{{ Auth::check() ? Auth::user()->cart->count() : '0' }}</span>
    </a>
    
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
        <li>
            <div {{ Auth::check() ? 'id=client-container' : 'id=product_container' }} >
            @if(Auth::check())
                <script>borrarCache();</script>
                @foreach(Auth::user()->cart as $cartItem)
                    {{ $cartItem->product->product_name }}
                    <br>---------------------<br>
                @endforeach
            @endif
            </div>
        </li>
                                           
        <li class="total">
            <span id="total-items"><strong>Total</strong>: ${{ Auth::check() ? Auth::user()->total : '0' }}</span>
            
            @if(Auth::check())
                <button class="btn btn-success btn-xs btn-pay">Pagar</button>
            @endif
        </li>
        <li class="text-center">
            <a href="{{ route('cart') }}">Ir a detalles</a>      
        </li>
           
    </ul>
</li>
   

