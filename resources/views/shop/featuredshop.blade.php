
<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="product_featured">
    <!--<form method="post" action="/priceLow">
    {{csrf_field()}}
    <input type="hidden" name="low" value="1">
    <input type="hidden" name="id" value="{{$banner->id}}">

    <button class="btn btn-default pull-left">Menor</button>
    </form>
    <form method="post" action="/priceLow">
    {{csrf_field()}}
    <input type="hidden" name="high" value="1">
    <input type="hidden" name="id" value="{{$banner->id}}">

    <button class="btn btn-primary pull-left">Mayor</button>
    </form>-->
    <form action="/pricelow" method="post">
        {{csrf_field()}}
        <div class="dropdown">
            <button class="btn btn-default btn-rounded waves-effect waves-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ordenar por
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
                <div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3 animated zoomIn grow card border-primary mb-2 ml-2 pt-3 pb-2">
                    <div id="product-container">
                        <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration:none;">
                            @if ($product->photos->count() == 0)
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
                                <div>
                                    <h6 class="center-on-small-only" id="featured-product-name">Codigo: {{ $product->product_sku }}</h6>
                                </div>
                                <div class="light-300 black-text medium-500" id="Product_Reduced-Price">$ {{  $product->price }}</div>
                        </a>
                    </div>
                    <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                    <input type="hidden" id="qty" value="1"/>
                    <input type="hidden" id="url" value="{{ route('addCart') }}">
                    <div class="col-12 col-sm-12 col-md-12 col-md-offset-3 text-center" style="width: 100%;">
                        <button class="btn btn-default btn-rounded waves-effect waves-light btn-block btn-addcart" value="{{$product->id}}" style="width: 100%; ">
                            <i class="fa fa-cart" aria-hidden="true"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    <div class="row justify-content-center mt-3 pl-5">
        {{ $products->links() }}
    </div>
</div>



