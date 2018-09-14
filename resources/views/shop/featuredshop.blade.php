
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="product_featured">
   
    <form action="/pricelow" method="post">
        {{csrf_field()}}
        <div class="dropdown">
            <button class="btn btn-default btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $orden }}
                <!--Ordenar por-->
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('shop.newest', $banner->id) }}">Popularidad</a>
                <a class="dropdown-item" href="{{ route('shop.lowest', $banner->id) }}">Menor Precio</a>
                <a class="dropdown-item" href="{{ route('shop.highest', $banner->id) }}">Mayor Precio</a>
                <a class="dropdown-item" href="{{ route('shop.alpha.lowest', $banner->id) }}">Productos A-Z</a>
                <a class="dropdown-item" href="{{ route('shop.alpha.highest', $banner->id) }}">Productos Z-A</a>
            </div>
        </div>
    </form>

    <h4 class="text-center animated zoomIn" id="title-product">Productos #</h4>
    <div class="text-center row d-flex flex-row-reverse">  
        @if($relacion)  
            @include('shop.featuredsold')
        @else                 
            @foreach($products as $product)
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-3 pt-3 pb-4">
                    <div id="product-container">
                        <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                            <div class="row">
                                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; ">
                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito">
                                        <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" style="margin-left: 220px;" value="{{$product->id}}">
                                            <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                                        </button>
                                    </span>
                                </div>
                                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 feactured-imagen d-block pt-5">
                                    @if ($product->photos->count() == 0)
                                        <img src="/images/no-image-found.jpg" alt="No Image Found Tag" id="Product-similar-Image" width="90%" height="90%">
                                    @else
                                        @if ($product->featuredPhoto)
                                            <img  src="{{$product->featuredPhoto->thumbnail_path}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="90%" height="90%"/><br>
                                            <br><span class="text-center label label-red" style="margin-left: 4em; color: red">- ${{ number_format($product->reduced_price, 2) }} <i class="fa fa-tag" aria-hidden="true"></i></span> 
                                            
                                        @elseif(!$product->featuredPhoto)
                                            <img  src="{{$product->photos->first()->thumbnail_path}}" alt="Photo" width="90%" height="90%"/>
                                        @else
                                            N/A
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div id="featured-product-name-container prod-featured" style="margin-top: 3em;">
                                @php
                                    $acorName = substr($product->product_name, 0, 25);
                                @endphp
                                <h6 class="center-on-small-only" id="featured-product-name"><br>{{ $acorName }}</h6>
                            </div>
                            <div>
                                <h6 class="center-on-small-only" id="featured-product-name">Código: {{ $product->product_sku }}</h6>
                            </div>
                            <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  number_format($product->price, 2) }}</div>
                        </a>
                    </div>
                    <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="/cart/add">
                </div>
            @endforeach
        @endif
    </div>
    <div class="row justify-content-center mt-3 pl-5">
        {{ $products->links() }}
    </div>
</div>

<script>
    $(function () {
        /*$(".dropdown-menu a").click(function () {
            var text_selected = $(this).text();
            $("#order").text(text_selected);
        });
        $(".order").text($orden);*/
    });
</script>

