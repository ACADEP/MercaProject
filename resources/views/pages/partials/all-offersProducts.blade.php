@extends('app')


@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Productos en Oferta</li>
    </ol>
</nav>    

<h1 class="text-center">Productos en Oferta</h1>

<div class="pt-3 pb-3">
    @if ($labels == 1)          
        @if ($brandFilter)
            @foreach ($brandFilter as $brand)
                <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{substr($brand, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($catFilter)
            @foreach ($catFilter as $cat)
                <span class="badge badge-primary badge-labeled cat badge-filter" style="font-size:15px;">{{substr($cat, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($maxfilter && $minFilter)
            <span class="badge badge-primary badge-labeled priceAll badge-filter" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
        @else
            @if ($maxfilter)
                <span class="badge badge-primary badge-labeled priceMax badge-filter" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
            @else
                @if ($minFilter)
                    <span class="badge badge-primary badge-labeled priceMin badge-filter" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                @endif
            @endif
        @endif
    @else
        @if ($labels == 0)
            @if ($brandFilter)
                @foreach ($brandFilter as $brand)
                    <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{$brand->brand_name}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($catFilter)
                @foreach ($catFilter as $cat)
                    <span class="badge badge-primary badge-labeled cat badge-filter" style="font-size:15px;">{{$cat->category}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($maxfilter && $minFilter)
                <span class="badge badge-primary badge-labeled priceAll badge-filter" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
            @else
                @if ($maxfilter)
                    <span class="badge badge-primary badge-labeled priceMax badge-filter" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
                @else
                    @if ($minFilter)
                        <span class="badge badge-primary badge-labeled priceMin badge-filter" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                    @endif
                @endif
            @endif
        @endif
    @endif    
</div>

<br>

<div class="row">
    <div class="row col-sm-3 col-md-3 mb-4">
        @include('pages.partials.filter-offer')
    </div>

    <div class="row col-sm-9 col-md-9 text-center ml-4">
        @foreach($products as $product)
            <div class="wow animated zoomIn m-2" id="product-sub-container" style="width: 235px !important;">
                <div class="text-center" style="margin-bottom:10px;"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span></div>
                <div class="row">
                    <div class="text-center hoverable" style="width:100%;">
                        <a class="link-products" href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                            @if ($product->photos->count() == 0)
                                    <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag" width="90%">
                            @else
                                @if ($product->featuredPhoto)
                                    <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="90%"/>
                                @elseif(!$product->featuredPhoto)
                                    <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo" width="90%"/>
                                @else
                                    N/A
                                @endif
                            @endif
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    @php
                        $acorName = substr($product->product_name, 0, 25);
                        $acorDesc = substr($product->description, 0, 25);
                    @endphp
                    <a class="link-products" href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                        <h5 class="center-on-small-only">{{ $acorName }}</h5>
                        <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                        <p>SKU: {{$product->product_sku}}</p>
                    </a>
                </div>
                <div class="text-center">
                    @if($product->reduced_price == 0)
                        <i class="fa fa-tag" style="color: green" aria-hidden="true"></i>$ {{ number_format($product->price, 2) }}
                        <br>
                    @else
                        <div class="text-danger list-price"><s style="color: red">$ {{ number_format($product->price, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                        <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format(($product->price-$product->reduced_price), 2) }}</div>
                    @endif
                        <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                        <input type="hidden" id="qty" value="1"/>
                        <input type="hidden" id="url" value="/cart/add">  
                </div>
                <div class="text-center" style="width:100%;">
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        @if(Auth::check())
                            <button  class="btn btn-warning btn-sm btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<div class="row justify-content-center mt-3 pl-5">
        {{ $products->appends(Request::input())->links() }}        
</div>


<script>
    $(function () {
        $('.activo').on('click', function(e) {
            $(e.target).closest('span').remove();
            var marca =  document.getElementsByClassName("brand");
            var categoria =  document.getElementsByClassName("cat");
            var priceAll =  document.getElementsByClassName("priceAll");
            var priceMax =  document.getElementsByClassName("priceMax");
            var priceMin =  document.getElementsByClassName("priceMin");
            var brand = new Array();
            var categories = new Array();
            var price;
            var desde = null;
            var hasta = null;
            var fil = 0;

            for(i = 0; i < marca.length; i++) {
                brand[i] = marca[i].innerText;
            }
            for(i = 0; i < categoria.length; i++) {
                categories[i] = categoria[i].innerText;
            }
            if (priceAll.length > 0) {
                for(i = 0; i < priceAll.length; i++) {
                    price = priceAll[i].innerText;
                }
                for(i = 0; i < price.length; i++) {
                    if (price[i+1] == 'a') {
                        desde = price.substring(1, i);
                        if (price[i+3] == '$') {
                            hasta = price.substring(i+4);
                        }
                    }
                }
            } 
            if (priceMax) {
                for(i = 0; i < priceMax.length; i++) {
                    price = priceMax[i].innerText;
                    hasta = price.substring(7);
                }
            } 
            if (priceMin) {
                for(i = 0; i < priceMin.length; i++) {
                    price = priceMin[i].innerText;
                    desde = price.substring(7);
                }
            }
            // console.log(brand);
            // console.log(categories);
            // console.log(hasta);
            // console.log(desde);
            get('/offers/filter', {brand:brand, categories:categories, hasta:hasta, desde:desde, fil:fil});
        })
    });
    
    function get(path, params, method) {
        method = method || "get"; // Set method to post by default if not specified.

        // The rest of this code assumes you are not using a library.
        // It can be made less wordy if you use one.
        var form = document.createElement("form");
        form.setAttribute("method", method);
        form.setAttribute("action", path);

        for(var key in params) {
            if(params.hasOwnProperty(key)) {
                var hiddenField = document.createElement("input");
                hiddenField.setAttribute("type", "hidden");
                hiddenField.setAttribute("name", key);
                hiddenField.setAttribute("value", params[key]);

                form.appendChild(hiddenField);
            }
        }

        document.body.appendChild(form);
        form.submit();
    }
</script>


@endsection

@section('footer')

@endsection