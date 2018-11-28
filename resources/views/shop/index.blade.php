@extends('app')

@section('content')

<style>
.productsshop {
    height: 100%;
    float: left;
}
.banner {
    display: block;
    width: 100%;
}
img.imgbanner {
    width: 100%;
    max-width: 100%;
    height: 150px;
    padding-left: 50%;
    /* margin-left: 50%; */
}
</style>

<div class="row mb-3" id="shops">

    <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
        <nav aria-label="breadcrumb" class="pt-3" style="width: 100%;">
            <ol class="breadcrumb breadcrumb-right-arrow">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/shops') }}">Tiendas</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{$banner->name}}</li>
            </ol>
        </nav>        
    </div>
    
    <div class="row col-8 col-sm-8 col-md-8 col-lg-8 col-xl-8 col-offset-2 col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-xl-offset-2">
            <img class="img-fluid imgbanner float-left" src="{{$banner->path}}" alt="First slide">
    </div>

    <div class="row col-12 col-sm-12 col-md-12 col-sm-12 col-lg-12">
        @include('shop.featuredshop')
    </div>
</div>

@endsection
