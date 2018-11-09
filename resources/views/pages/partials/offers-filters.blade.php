<style>
    .ajuste {
    }
    .alineado {
    }
    .ordenado {
    }
    .filters {
        padding-left: 3px;
    }
</style>
<div class="alineado ordenado col-sm-2 col-md-2 col-lg-2">
    <form action="/pricelow" method="post">
        {{csrf_field()}}
        <div class="dropdown">
            <button class="btn btn-info btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $ordenamiento }}
            </button>       
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ route('offers.newest') }}">Popularidad</a>
                <a class="dropdown-item" href="{{ route('offers.lowest') }}">Menor Precio</a>
                <a class="dropdown-item" href="{{ route('offers.highest') }}">Mayor Precio</a>
                <a class="dropdown-item" href="{{ route('offers.alpha.lowest') }}">Productos A-Z</a>
                <a class="dropdown-item" href="{{ route('offers.alpha.highest') }}">Productos Z-A</a>
            </div>
        </div>
    </form>
</div>
<div class="filters col-sm-10 col-md-10 col-lg-10">
    <form class="form-inline" action="{{route('offer.filter')}}" method="GET">
        <div class="form-row align-items-center">
            <div class="dropdown ajuste alineado" >
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Marcas
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check filter-color text-left" aria-labelledby="dropdownMenu1">
                    @foreach ($marcas as $marca)
                        <li><label for="{{'bra'.$marca->id}}"><input class="text-left" type="checkbox" name="brand[]" value="{{$marca->id}}, {{$marca->brand_name}}" id="{{'bra'.$marca->id}}" /><strong class="ml-1">{{$marca->brand_name}}</strong></label></li>
                    @endforeach
                </ul>
            </div>

            <div class="dropdown ajuste alineado" >
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Categorias   
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check filter-color" aria-labelledby="dropdownMenu2">
                    @foreach ($categorias as $categoria)
                        <li><label for="{{'cat'.$categoria->id}}"><input class="text-left" type="checkbox" name="categories[]" value="{{$categoria->id}}, {{$categoria->category}}" id="{{'cat'.$categoria->id}}" /><strong class="ml-1">{{$categoria->category}}</strong></label></li>
                    @endforeach
                </ul>
            </div>

            <div class="ajuste minimo">
                <input type="text" name="desde" class="form-control" placeholder="$ Mínimo" style="width: 100px;">
            </div>

            <div class="ajuste maximo">
                <input type="text" name="hasta" class="form-control ml-2" placeholder="$ Máximo" style="width: 100px;">
            </div>    

            <div class="ajuste alineado">
                <input type="hidden" name="fil" value="1">
                <button class="btn btn-info" type="submit"><i class="fa fa-search fa-lg" style="width: 20px;" aria-hidden="true"></i></button>
            </div> 
        </div>
    </form>
</div>
    