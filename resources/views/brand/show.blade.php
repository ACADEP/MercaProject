@extends('app')


@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $orden->brand_name }}</li>
    </ol>
</nav>    

<h1 class="text-center">
    {{-- @foreach($brands as $brand) --}}
        {{ $orden->brand_name }}
    {{-- @endforeach --}}
</h1>

{{-- <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Ordenar por
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li><a href="{{ route('brand.newest', $brands->id) }}">Mas nuevos</a></li>
        <li><a href="{{ route('brand.lowest', $brands->id) }}">Precio mas bajo</a></li>
        <li><a href="{{ route('brand.highest', $brands->id) }}">Precio mas alto</a></li>
        <li><a href="{{ route('brand.alpha.lowest', $brands->id) }}">Productos A-Z</a></li>
        <li><a href="{{ route('brand.alpha.highest', $brands->id) }}">Productos Z-A</a></li>
    </ul>
</div> --}}

<div class="row col-12 col-sm-12 col-md-12 col-lg-12 mt-5">
    @include('partials.filters')
</div>



<br>
{{-- <p class="text-md-left">{{ $count }} {{ str_plural('productos', $count) }}</p> --}}

<div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
@foreach($products as $product)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow animated zoomIn  m-2" id="product-sub-container" style="max-width: 23%; ">
        <div class="text-center" style="margin-bottom:10px;"> <span class="badge badge-primary" style="font-size:15px;">{{$product->brand->brand_name}}</span> </div>
            <div class="row">
                
                <div class="col-md-12 text-center hoverable" style="width:100%;">
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
            <div class="col-md-12 text-center" style="width:100%;">
                    <div class="text-center">
                        <button class="btn btn-primary btn-sm btn-addcart"  data-toggle="tooltip" title="Agregar al carrito" value="{{$product->id}}">
                            <i class="fa fa-shopping-cart"></i>
                        </button>
                        @if(Auth::check())
                            <button  class="btn btn-danger btn-sm btn-favorite"  data-toggle="tooltip" title="Agregar a favoritos"  data-toggle="tooltip" title="Agregar a favoritos" value="{{$product->id}}">
                                <i class="fa fa-heart" aria-hidden="true"></i>
                            </button>
                        @endif
                    </div>
                </div>
        </div>
       
    @endforeach
</div>


@endsection

@section('footer')

@endsection