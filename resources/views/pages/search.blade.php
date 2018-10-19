@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-2">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
    </ol>
</nav>  
     
<h4><br>
    Resultados para:  <i>{{ $query }}</i>
</h4><br>
<div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
    @if (count($search) == 0 || $search==null)
        <div class="text-center" style="height:300px;"><h1>No hay productos</h1> </div>   
    @elseif (count($search) >= 1)
        @foreach($search as $query)
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 wow slideInLeft mb-2 ml-3 pt-3 pb-2" id="product-sub-container" style="max-width: 23%;">
                <div class="row">
                    <div class="row col-3 col-sm-3 col-md-3 col-lg-3 pl-1" style="float: left; height: 80%;">
                        <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Agregar al carrito" style="margin-left: 460%;">
                            <button class="btn btn-primary btn-rounded waves-effect waves-light btn-addcart" value="{{$query->id}}">
                                <i class="material-icons" style="line-height: 2">add_shopping_cart</i><!--<i class="fa fa-plus" aria-hidden="true"></i>Agregar al carrito-->
                            </button>
                        </span>
                    </div>
                    <div class="row col-9 col-sm-9 col-md-9 col-lg-9 d-block pt-1 text-center hoverable">
                        <a href="{{ route('show.product', $query->product_name) }}">
                        @if ($query->photos->count() === 0)
                                <img src="/images/no-image-found.jpg" class="img-fluid" alt="No Image Found Tag">
                        @else
                            @if ($query->featuredPhoto)
                                <img src="{{$query->featuredPhoto->thumbnail_path}}" class="img-fluid" alt="Photo ID: {{ $query->featuredPhoto->id }}" width="100%" />
                            @elseif(!$query->featuredPhoto)
                                <img src="{{$query->photos->first()->thumbnail_path}}" class="img-fluid" alt="Photo" />
                            @else
                                N/A
                            @endif
                        @endif
                        </a>
                    </div>
                </div>
                <div class="text-center">
                    @php
                        $acorName = substr($query->product_name, 0, 25);
                        $acorDesc = substr($query->description, 0, 25);
                    @endphp
                    <a href="{{ route('show.product', $query->product_name) }}">
                    <h5 class="center-on-small-only">{{ $acorName }}</h5>
                    <h6 class="center-on-small-only">Marcas: {{ $query->brand->brand_name }}</h6>
                    <p style="font-size: .9em;">{!! nl2br(str_limit($query->description, $limit = 200, $end = '...')) !!}</p>
                    </a>
                </div>
                <div class="text-center">
                    @if($query->reduced_price == 0)
                        <i class="fa fa-tag" style="color: green" aria-hidden="true"></i> $ {{  $query->price }}
                        <br>
                    @else
                        <div class="text-danger list-price"><s style="color: red">$ {{ number_format($query->price, 2) }}<i class="fa fa-tag" aria-hidden="true"></i></s></div>
                        <div class="blue-text light-300 medium-500" id="Product_Reduced-Price">$ {{ number_format(($query->price-$query->reduced_price), 2) }}</div>
                    @endif
                        <input type="hidden" id="product_id{{$query->id}}" value="{{$query->id}}"/>
                        <input type="hidden" id="qty" value="1"/>
                        <input type="hidden" id="url" value="/cart/add">
                        
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
