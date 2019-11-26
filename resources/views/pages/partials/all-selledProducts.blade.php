@extends('app')


@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Más Vendidos</li>
    </ol>
</nav>    

<h1 class="text-center">Más Vendidos</h1>

<div class="row">
    <div class="row col-sm-3 col-md-3 mb-4">
        @include('pages.filter',["route"=>route('selled.order')])
    </div>

    <div class="row col-sm-9 col-md-9 text-center ml-4">
        @include('pages.utils.product-card', ["data"=>$selledProducts])
    </div>
</div>

<div class="row justify-content-center mt-3 pl-5">
        {{ $selledProducts->appends(Request::input())->links() }}        
</div>



@endsection

