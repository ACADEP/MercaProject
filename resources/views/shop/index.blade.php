@extends('app')

@section('content')

<style>
.filter {
    height: 100%;
    width: 300px;
}
.productsshop {
    height: 100%;
}
</style>

<div class="row" id="shops">
    <h2 class="text-left" id="title-shop"># Tienda oficial</h2>
    <div class="col-12 text-center">
        <div class="card border-primary mb-3 text-center">
            @if ($banner->photos->count() === 0)
                <img src="{{asset('images/no-image-found.jpg')}}" alt="No Image Found Tag" id="Product-similar-Image" class="col-sm-6 col-md-8 col-lg-8">
            @else
                @if ($banner->featuredPhoto)
                    <img  src="{{asset($product->featuredPhoto->thumbnail_path)}}" alt="Photo ID: {{ $product->featuredPhoto->id }}" class="col-sm-6 col-md-8 col-lg-8" width="100px"/><br>
                    <span class="label label-red" style="color: red">- ${{$product->reduced_price}}</span>
                @elseif(!$banner->featuredPhoto)
                    <img  src="{{asset($product->photos->first()->thumbnail_path)}}" class="col-sm-6 col-md-8 col-lg-8" alt="Photo" />
                @else
                    N/A
                @endif
            @endif
            <img class="d-block w-100" src="{{ asset('/images/Shops/apple_store.jpeg') }}" alt="First slide">
        </div>
    </div>

    <div class="row col-sm-2 col-md-2 filter">
        @include('shop.filter')
    </div>

    <div class="productsshop">
        @include('shop.featuredshop')
    </div>
</div>

@endsection
