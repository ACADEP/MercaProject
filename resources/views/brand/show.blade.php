@extends('app')


@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $brands->brand_name }}</li>
    </ol>
</nav>    

<h1 class="text-center">
    {{-- @foreach($brands as $brand) --}}
        {{ $brands->brand_name }}
    {{-- @endforeach --}}
</h1>

<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar por
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a href="{{ route('brand.newest', $brands->id) }}">Mas nuevos</a></li>
        <li><a href="{{ route('brand.lowest', $brands->id) }}">Precio mas bajo</a></li>
        <li><a href="{{ route('brand.highest', $brands->id) }}">Precio mas alto</a></li>
        <li><a href="{{ route('brand.alpha.lowest', $brands->id) }}">Productos A-Z</a></li>
        <li><a href="{{ route('brand.alpha.highest', $brands->id) }}">Productos Z-A</a></li>
    </ul>
</div>



<br>
<p class="text-md-left">{{ $count }} {{ str_plural('productos', $count) }}</p>

<div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    @foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow slideInLeft mb-2 ml-3 pt-3 pb-2" id="product-sub-container" style="max-width: 23%;">
            <div class="row">
                <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; height: 80%;">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito" style="margin-left: 460%;">
                            <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" value="{{$product->id}}">
                                <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                            </button>
                        </span>
                </div>
                <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1 text-center hoverable">
                    <a href="{{ route('show.product', $product->product_name) }}">
                    @if ($product->photos->count() === 0)
                            <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag" id="Product-similar-Image">
                    @else
                        @if ($product->featuredPhoto)
                            <img src="{{$product->featuredPhoto->thumbnail_path}}" class="img-fluid" alt="Photo ID: {{ $product->featuredPhoto->id }}" width="100%" />
                        @elseif(!$product->featuredPhoto)
                            <img src="{{$product->photos->first()->thumbnail_path}}" class="img-fluid" alt="Photo" />
                        @else
                            N/A
                        @endif
                    @endif
                    </a>
                </div>            
            </div>
            <div class="text-center">
                <a href="{{ route('show.product', $product->product_name) }}">
                <h5 class="center-on-small-only">{{ $product->product_name }}</h5>
                <h6 class="center-on-small-only">Brand: {{ $product->brand->brand_name }}</h6>
                <p style="font-size: .9em;">{!! nl2br(str_limit($product->description, $limit = 200, $end = '...')) !!}</p>
                </a>
            </div>
            <div class="text-center">
                @if($product->reduced_price == 0)
                    $ {{  $product->price }}
                    <br>
                @else
                    <div class="text-danger list-price"><s>$ {{ $product->price }}</s></div>
                    <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format(($product->price-$product->reduced_price), 2) }}</div>
                @endif
                <input type="hidden" id="product_id{{$product->id}}" value="{{$product->id}}"/>
                <input type="hidden" id="qty" value="1"/>
                <input type="hidden" id="url" value="/cart/add">

            </div>
        </div>
    @endforeach
</div>


@endsection

@section('footer')

@endsection