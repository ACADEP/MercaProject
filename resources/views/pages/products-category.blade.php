@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/allcategory') }}">Categorias</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">{{ $orden->brand_name }}</li> --}}
    </ol>
</nav>    

@if ($products->count() == 0)
<div class="text-center" style="height:300px;"><h1>No hay productos en esta categoría</h1> </div>
@else   
<h3 class="pt-2">Categoria: {{ $products->first()->category->category }}</h3>





@if(isset($order))
   <script>$("#s-order").val("{{ $order }}")</script>
@endif
    <div class="row">
        <div class="row col-sm-3 col-md-3">
                @include('pages.filter',["route"=>route('orderCategory',$products->first()->category)])
        </div>
    
        <div class="row col-sm-9 col-md-9 text-center ml-4">
                @include('pages.utils.product-card', ["data"=>$products])
        </div>
    </div>
    <div class="row justify-content-center mt-3 pl-5">
        {{ $products->appends(Request::input())->links() }}
    </div>        
@endif



@stop