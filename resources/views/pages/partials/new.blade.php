
<div class="col-md-12" id="new_product">
<h4 class="text-left animated zoomIn" id="title-product">Nuevos productos</h4>
    <div class="text-center row d-flex flex-nowrap">
        <div class="container-fluid" id="Index-Main-Container">
            <div id="featured-products-sub-container">
                <div class="row d-flex flex-nowrap">
                 @foreach($new as $product)
                    <div class="col-4 col-sm-4 col-md-3 col-lg-3 col-xl-3 wow zoomIn grow card border-primary mb-2 ml-2 pb-4">
                        <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" style="margin-left: 220px;" value="{{$product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                    </span>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-5">
                                    @if ($product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" width="90px" height="90%">
                                    @else
                                        @if ($product->featuredPhoto)
                                            <img src="{{$product->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="90px" height="90%"/>
                                            <br><br><span class=" text-center label label-red" style="margin-left: 4em; color: red">- ${{ number_format($product->reduced_price, 2) }} <i class="fa fa-tag" aria-hidden="true"></i></span> 
                                        @elseif(!$product->featuredPhoto)
                                            <img src="{{$product->photos->first()->path}}" alt="Photo" width="90px" height="90%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                                
                            </div>
                            <div id="featured-product-name-container">
                                @php
                                    $acorName = substr($product->product_name, 0, 25);
                                @endphp
                                <br><h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $product->product_sku }}</h6>
                            </div>
                            @if($product->reduced_price == 0)
                                <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  number_format($product->price, 2) }}</div>
                            @else
                                <div class="green-text medium-500" id="Product_Reduced-Price">$ {{ number_format($product->reduced_price, 2) }}</div>
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



