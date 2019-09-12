@extends('app')


@section('content')

<nav aria-label="breadcrumb" class="pt-3">
    <ol class="breadcrumb breadcrumb-right-arrow">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/brands') }}">Marcas</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $orden->brand_name }}</li>
    </ol>
</nav>    

<h1 class="text-center">{{ $orden->brand_name }}</h1>

<div class="pt-3">
    @if ($labels == 1)          
        @if ($brandFilter)
            @foreach ($brandFilter as $brand2)
                <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{substr($brand2, 3)}}<i class="fa fa-times activo"></i></span>  
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
                @foreach ($brandFilter as $brand2)
                    <span class="badge badge-primary badge-labeled brand badge-filter" style="font-size:15px;">{{$brand2->brand_name}}<i class="fa fa-times activo"></i></span>  
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


<br>

<div class="row">
    <div class="row col-sm-3 col-md-3">
        @include('brand.filter')
    </div>

    <div class="row col-sm-9 col-md-9 text-center ml-4">
            @include('pages.utils.product-card', ["data"=>$products])
    </div>
</div>

<div class="row justify-content-center mt-3 pl-5">
    {{ $products->appends(Request::input())->links() }}
</div>


<script>
        $(function () {
            $('.activo').on('click', function(e) {
                $(e.target).closest('span').remove();
                // var marca =  document.getElementsByClassName("brand");
                var categoria =  document.getElementsByClassName("cat");
                var priceAll =  document.getElementsByClassName("priceAll");
                var priceMax =  document.getElementsByClassName("priceMax");
                var priceMin =  document.getElementsByClassName("priceMin");
                var brand = new Array();
                var categories = new Array();
                var price;
                var desde = null;
                var hasta = null;
                var fil = 0;
    
                // for(i = 0; i < marca.length; i++) {
                //     brand[i] = marca[i].innerText;
                // }
                for(i = 0; i < categoria.length; i++) {
                    categories[i] = categoria[i].innerText;
                }
                // console.log(priceMin);
                // console.log(priceAll);
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
                // console.log(brand);
                // console.log(categories);
                // console.log(hasta);
                // console.log(desde);
                get('/bran/{{$brands->id}}/filter', {brand:null, categories:categories, hasta:hasta, desde:desde, fil:fil, id:{{$brands->id}}});
            });
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


@section('footer')

@endsection

