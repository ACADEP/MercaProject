
<div class="col-md-12" id="new_product">
<h4 class="text-left animated zoomIn" id="title-product">Nuevos productos</h4>
<a href="{{ route('all.shops') }}">Ver todas</a>
    <div class="text-center row">
        <div class="container-fluid" id="Index-Main-Container">
            <div id="featured-products-sub-container">
                <div class="row">
                 @foreach($new as $product)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow zoomIn grow card border-primary mb-2 ml-3 pt-3 pb-2" style="max-width: 23%;">
                    <div class="text-center"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span> </div>
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1">
                                    <span class="d-inline-block" tabindex="0"  style="margin-left: 450%;">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                        @if(Auth::check())
                                        <button class="btn btn-danger btn-xs waves-effect waves-light btn-favorite" data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                            <i class="fa fa-heart" aria-hidden="true"></i>
                                        </button>
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1">
                                <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                                    @if ($product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag" id="Product-similar-Image" width="80%" height="80%">
                                    @else
                                        @if ($product->featuredPhoto)
                                            <img src="{{$product->featuredPhoto->thumbnail_path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="80%" height="80%"/>
                                            @if($product->reduced_price != 0)
                                                <br><span class="text-center label label-red" style="margin-left: 20%; color: red"><s style="color: red;">${{ number_format($product->price, 2) }} <i class="fa fa-tag" aria-hidden="true"></i></s></span>
                                            @endif 
                                        @elseif(!$product->featuredPhoto)
                                            <img src="{{$product->photos->first()->path}}" class="img-fluid" alt="Photo" width="80px" height="80%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                            </a>
                            </div>
                            <div id="featured-product-name-container">
                                @php
                                    $acorName = substr($product->product_name, 0, 25);
                                @endphp
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $product->product_sku }}</h6>
                            </div>
                            @if($product->reduced_price == 0)
                                <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{  number_format($product->price, 2) }}</div>
                            @else
                                <div class="blue-text medium-500" id="Product_Reduced-Price">$ {{ number_format(($product->price-$product->reduced_price), 2) }}</div>
                            @endif
                        </a>
                        <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                        <input type="hidden" id="qty" value="1"/>
                        <input type="hidden" id="url" value="/cart/add">
                    </div>
                 @endforeach 
                </div>
            </div>  
        </div>
    </div>
</div>



