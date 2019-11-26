@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Búsqueda avanzada</li>
    </ol>
</nav>  



<div class="row">
    <div class="row col-sm-3 col-md-3">
        @include('pages.filter',["route"=>route('special.filter')])
    </div>

    <div class="row col-sm-9 col-md-9 text-center ml-4">
        @include('pages.utils.product-card',["data"=>$products])
    </div>
</div>

<div class="row justify-content-center mt-3 pl-5">
    {{ $products->appends(Request::input())->links() }}        
</div>   




@endsection
