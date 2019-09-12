
<li class="nav-item dropdown" >
                            
    <a class="nav-link hidden-md-down"  role="button" href="#" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="material-icons"> shopping_cart</i><span class="badge" id="badge-cart">{{ Auth::check() ? Auth::user()->cart->count() : '0' }}</span>
    </a>
    
    <ul class="dropdown-menu" style="width:100%;" aria-labelledby="navbarDropdown">
    
        <li style="width:100%;">
       
            <div {{ Auth::check() ? 'id=client-container' : 'id=product_container' }} class="row">
            @if(Auth::check())
            
                <script>borrarCache();</script>
                @php $tItems=0 @endphp
                @if(Auth::user()->cart->count()>0)
                @foreach(Auth::user()->cart->with('product')->get() as $cartItem)
                    
                    @if($tItems<=4)
                   
                        <div class="col-md-3"> <img  style="width:100%;" src="{{ $cartItem->product->photos()->first()->path }}"></div>
                        <div class="col-md-9" ><span class="badge badge-primary" style="font-size:12px; width:100%;">{{ $cartItem->product->product_name }}</span> <br><span class="badge badge-success">${{number_format($cartItem->product->real_price, 2)}}</span> </div>
                        <div class="col-md-12 "><hr></div>
          
                    @endif
                    @php $tItems++ @endphp
                @endforeach
                @else
                <div class='col-md-12 text-center'>No hay productos en el carrito</div>
                @endif
            @endif
            </div>
            
        </li>
          
        <li class="text-center" style="width:100%;" >
            <a  href="{{ route('cart') }}"  id="cart-detail">Ver carrito</a>   
        </li>
           
    </ul>
</li>
   

