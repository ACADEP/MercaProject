
<div class="col-12 col-sm-12 col-md-12 col-lg-12" id="product_featured">
    <h4 class="text-left animated zoomIn" id="title-product">Productos destacados</h4>
    <div class="text-center row d-flex flex-nowrap">                     
        @foreach($products as $product)
            <div class="col-4 col-sm-3 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-2 pt-5 pb-5">
                <div id="product-container">
                    <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                        <div class="row">
                            <div class="col-9 col-sm-9 col-md-9 col-lg-9" style="float: left;">
                                @if ($product->photos->count() == 0)
                                    <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" width="90px" height="90%">
                                @else
                                    @if ($product->featuredPhoto)
                                        <img  src="{{$product->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="90px" height="90%"/><br>
                                        <br><span class=" text-center label label-red" style="margin-left: 4em; color: red">- ${{$product->reduced_price}} <i class="fa fa-tag" aria-hidden="true"></i></span> 
                                    @elseif(!$product->featuredPhoto)
                                        <img  src="{{$product->photos->first()->thumbnail_path}}" alt="Photo" width="90px" height="90%"/>
                                    @else
                                        N/A
                                    @endif
                                @endif
                            </div>
                            <div class="col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left;">
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito"> 
                                    <button class="btn btn-default btn-rounded waves-effect waves-light btn-addcart" value="{{$product->id}}">
                                        <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                    </button>
                                </span>
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
                        <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                    </a>
                </div>
                <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                <input type="hidden" id="qty" value="1"/>
                <input type="hidden" id="url" value="/cart/add">
            </div>
        @endforeach
    </div>
</div>



