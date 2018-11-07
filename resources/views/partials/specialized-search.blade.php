@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
    </ol>
</nav>  

@if (count($products) != 0 || $products!=null)
    <div class="row col-12 col-sm-12 col-md-12 col-lg-12 mt-3">
        @include('partials.special-filters')
    </div>
@endif

<style>
    .badge {
        margin-right: .3rem;
    }
    /***** REQUIRED STYLES *****/
    .badge-labeled {
        padding-top: 0;
        padding-bottom: 0;
        padding-right: 0.2rem;
    }
    .badge-labeled i {
        padding: 0.25em  0.3rem;
        cursor: pointer;
        position: relative;
        display: inline-block;
        right: -0.2em;
        border-left: solid 1px rgba(255,255,255,.5);
        border-radius: 0 0.25rem 0.25rem 0;
    }
</style>

<div class="pt-3 pb-3">
    @if ($labels == 1)          
        @if ($brandFilter)
            @foreach ($brandFilter as $brand)
                <span class="badge badge-primary badge-labeled brand" style="font-size:15px;">{{substr($brand, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($catFilter)
            @foreach ($catFilter as $cat)
                <span class="badge badge-primary badge-labeled cat" style="font-size:15px;">{{substr($cat, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($maxfilter && $minFilter)
            <span class="badge badge-primary badge-labeled priceAll" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
        @else
            @if ($maxfilter)
                <span class="badge badge-primary badge-labeled priceMax" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
            @else
                @if ($minFilter)
                    <span class="badge badge-primary badge-labeled priceMin" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                @endif
            @endif
        @endif
    @else
        @if ($labels == 0)
            @if ($brandFilter)
                @foreach ($brandFilter as $brand)
                    <span class="badge badge-primary badge-labeled brand" style="font-size:15px;">{{$brand->brand_name}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($catFilter)
                @foreach ($catFilter as $cat)
                    <span class="badge badge-primary badge-labeled cat" style="font-size:15px;">{{$cat->category}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($maxfilter && $minFilter)
                <span class="badge badge-primary badge-labeled priceAll" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
            @else
                @if ($maxfilter)
                    <span class="badge badge-primary badge-labeled priceMax" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
                @else
                    @if ($minFilter)
                        <span class="badge badge-primary badge-labeled priceMin" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                    @endif
                @endif
            @endif
        @endif
    @endif
</div>
     
<div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    @if (count($products) == 0 || $products==null)
        <div class="text-center" style="height:300px;"><h1>No hay productos</h1> </div>   
    @elseif (count($products) >= 1)
        @foreach($products as $product)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow slideInLeft mb-2 ml-3 pt-3 pb-2" id="product-sub-container" style="max-width: 23%;">
            <div class="text-center"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span> </div>
                <div class="row">
                    <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; height: 80%;">
                        <span class="d-inline-block" tabindex="0" style="margin-left: 460%;">
                            <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                                <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                            </button>
                            @if(Auth::check())
                                <button class="btn btn-danger btn-xs waves-effect waves-light btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                    <i class="fa fa-heart" aria-hidden="true"></i>
                                </button>
                            @endif
                        </span>
                    </div>
                    <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1 text-center hoverable">
                        <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                        @if ($product->photos->count() == 0)
                                <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag">
                        @else
                            @if ($product->featuredPhoto)
                                <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100%" />
                            @elseif(!$product->featuredPhoto)
                                <img src="{{$product->photos()->first()->path}}" class="img-fluid" alt="Photo" />
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
                    <a href="{{ route('show.product', $product->product_name) }}" style="text-decoration: none;">
                    <h5 class="center-on-small-only">{{ $acorName }}</h5>
                    <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                    </a>
                </div>
                <div class="text-center">
                    @if($product->reduced_price == 0)
                        <i class="fa fa-tag" style="color: green" aria-hidden="true"></i> $ {{  $product->price }}
                        <br>
                    @else
                        <div class="text-danger list-price"><s style="color: red">$ {{ number_format($product->price, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                        <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format(($product->price-$product->reduced_price), 2) }}</div>
                    @endif
                        <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                        <input type="hidden" id="qty" value="1"/>
                        <input type="hidden" id="url" value="/cart/add">
                        
                </div>
            </div>
        @endforeach
    @endif
</div>

@if (count($products) != 0 || $products!=null)
    <div class="row justify-content-center mt-3 pl-5">
        {{ $products->appends(Request::input())->links() }}        
    </div>    
@endif

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
            get('/queries/filter', {brand:brand, categories:categories, hasta:hasta, desde:desde, fil:fil});
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
