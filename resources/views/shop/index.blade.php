@extends('app')

@section('content')

<style>
.filter {
    height: 100%;
    width: 300px;
    float: left;
}
.productsshop {
    height: 100%;
    float: left;
}
.banner {
    display: block;
    width: 100%;
}
img imgbanner {
    width: 100%;
    max-width: 100%;
    height: 250px;
}
</style>

<div class="row" id="shops">
    
    <div class="row col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
        <h2 class="text-left" id="title-shop"># Tienda oficial</h2>
        <div class="card border-primary mb-3 text-center banner">
            <img class="d-block w-100 imgbanner" src="{{ asset($banner->path) }}" alt="First slide" width="100%" height="200">
        </div>
    </div>



    <div class="productsshop col-md-10 col-sm-10 col-lg-10">
        @include('shop.featuredshop')
    </div>
</div>

@endsection
