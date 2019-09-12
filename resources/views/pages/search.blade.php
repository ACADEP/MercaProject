@extends('app')

@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item active" aria-current="page">Busqueda</li>
    </ol>
</nav>  

<div class="pt-3 pb-3">
    @if ($labels == 1)          
        @if ($brandFilter)
            @foreach ($brandFilter as $brand)
                <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{substr($brand, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($catFilter)
            @foreach ($catFilter as $cat)
                <span class="badge badge-primary badge-labeled cat badge-filter" style="font-size:15px;">{{substr($cat, 3)}}<i class="fa fa-times activo"></i></span>  
            @endforeach
        @endif
        @if ($maxfilter && $minFilter)
            <span class="badge badge-primary badge-labeled priceAll badge-filter" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
        @else
            @if ($maxfilter)
                <span class="badge badge-primary badge-labeled priceMax badge-filter" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
            @else
                @if ($minFilter)
                    <span class="badge badge-primary badge-labeled priceMin badge-filter" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                @endif
            @endif
        @endif
    @else
        @if ($labels == 0)
            @if ($brandFilter)
                @foreach ($brandFilter as $brand)
                    <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{$brand->brand_name}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($catFilter)
                @foreach ($catFilter as $cat)
                    <span class="badge badge-primary badge-labeled cat badge-filter" style="font-size:15px;">{{$cat->category}}<i class="fa fa-times activo"></i></span>  
                @endforeach
            @endif
            @if ($maxfilter && $minFilter)
                <span class="badge badge-primary badge-labeled priceAll badge-filter" style="font-size:15px;">${{$minFilter}} a ${{$maxfilter}}<i class="fa fa-times activo"></i></span>
            @else
                @if ($maxfilter)
                    <span class="badge badge-primary badge-labeled priceMax badge-filter" style="font-size:15px;">Hasta ${{$maxfilter}}<i class="fa fa-times activo"></i></span>  
                @else
                    @if ($minFilter)
                        <span class="badge badge-primary badge-labeled priceMin badge-filter" style="font-size:15px;">Desde ${{$minFilter}}<i class="fa fa-times activo"></i></span>
                    @endif
                @endif
            @endif
        @endif
    @endif
</div>
     
<h4><br>
    @if (count($search) != 0 || $search != null)
        <i>{{ $resultados }} resultados para <i class="search_find">{{ $search_find }}</i></i>
    @else
        <i class="search_find">No se resultados para {{ $search_find }}</i>
    @endif

</h4><br>

<div class="row">
    @if (count($search) != 0 || $search != null)
        <div class="row col-sm-3 col-md-3">
            @include('pages.filter')
        </div>    
        <div class="row col-sm-9 col-md-9 text-center ml-4">
                @include('pages.utils.product-card', ["data"=>$search])
        </div>
    @endif
</div>

@if (count($search) != 0 || $search!=null)
    <div class="row justify-content-center mt-3 pl-5">
        {{ $search->appends(Request::input())->links() }}        
    </div>    
@endif

<div class="row mb-4"></div>

<script>
    $(function () {
        $('.activo').on('click', function(e) {
            $(e.target).closest('span').remove();
            var marca =  document.getElementsByClassName("brand");
            var categoria =  document.getElementsByClassName("cat");
            var priceAll =  document.getElementsByClassName("priceAll");
            var priceMax =  document.getElementsByClassName("priceMax");
            var priceMin =  document.getElementsByClassName("priceMin");
            var search_find =  document.getElementsByClassName("search_find");
            var brand = new Array();
            var categories = new Array();
            var price;
            var desde = null;
            var hasta = null;
            var search;
            var fil = 0;

            for(i = 0; i < search_find.length; i++) {
                search = search_find[i].innerText;
            }
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
            console.log(search);
            // console.log(brand);
            // console.log(categories);
            // console.log(hasta);
            // console.log(desde);
            get('/queries/filter', {brand:brand, categories:categories, hasta:hasta, desde:desde, fil:fil, search:search});
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
