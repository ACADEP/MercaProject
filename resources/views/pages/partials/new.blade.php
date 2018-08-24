
<div class="col-md-12" id="new_product">
<h4 class="text-left animated zoomIn" id="title-product">Nuevos productos</h4>
    <div class="text-center wow">
        
        <div class="container-fluid" id="Index-Main-Container">

            <div id="featured-products-sub-container">
                <div class="row">
                 @foreach($new as $product)

                    <div class="col-sm-6 col-md-3 wow zoomIn grow" id="featured-container">
                            <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                            @if ($product->photos->count() === 0)
                                <img src="{{asset('/images/no-image-found.jpg')}}" alt="No Image Found Tag" id="Product-similar-Image" style="width: 200px; height: 200px;">
                            @else
                                @if ($product->featuredPhoto)
                                    <img src="{{asset($product->featuredPhoto->thumbnail_path)}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" style="width: 200px; height: 200px;"/>
                                @elseif(!$product->featuredPhoto)
                                    <img src="{{asset($product->photos->first()->path)}}" alt="Photo" />
                                @else
                                    N/A
                                @endif
                            @endif
                                <div id="featured-product-name-container">
                                    <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $product->product_name }}</h6>
                                </div>
                                <div>
                                    <h6 class="center-on-small-only" id="featured-product-name">Codigo: {{ $product->product_sku }}</h6>
                                </div>
                                @if($product->reduced_price == 0)
                                    <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                                @else
                                    <div class="green-text medium-500" id="Product_Reduced-Price">$ {{ $product->reduced_price }}</div>
                                @endif
                            </a>
                            
                            <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                            <input type="hidden" id="qty" value="1"/>
                            <input type="hidden" id="url" value="{{ route('addCart') }}">
                            <button class="btn btn-default btn-addcart" value="{{$product->id}}"><i class="fa fa-cart" aria-hidden="true"></i>Agregar al carrito</button>
                    </div>
                 @endforeach 
                </div>
            </div>  
        </div>
    </div>
</div>



