
<div class="col-md-12" id="product_featured">
    <h4 class="text-left animated zoomIn" id="title-product">Productos destacados</h4>
        <div class="text-center row" >            
                    
                        @foreach($products as $product)
                            
                            <div class="col-sm-6 col-md-3 animated zoomIn">
                                <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                                @if ($product->photos->count() === 0)
                                    <img src="{{asset('images/no-image-found.jpg')}}" alt="No Image Found Tag" id="Product-similar-Image">
                                @else
                                    @if ($product->featuredPhoto)
                                        <img  src="{{asset($product->featuredPhoto->thumbnail_path)}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100px"/><br>
                                        <span class="label label-red" style="color: red">- ${{$product->reduced_price}}</span>
                                    @elseif(!$product->featuredPhoto)
                                        <img  src="{{asset($product->photos->first()->thumbnail_path)}}" alt="Photo" />
                                    @else
                                        N/A
                                    @endif
                                @endif
                                    <div id="featured-product-name-container">
                                        <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $product->product_name }}</h6>
                                    </div>
                                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                                   
                                </a>
                                <form action="/store/cart/add" method="post" name="add_to_cart">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="product" value="{{$product->id}}" />
                                    <input type="hidden" name="qty" value="1" />
                                    <button class="btn btn-default waves-effect waves-light"><i class="fa fa-cart" aria-hidden="true"></i>Agregar al carrito</button>
                                </form>
                            </div>
                        @endforeach
                    
               
            
        </div>
</div>

