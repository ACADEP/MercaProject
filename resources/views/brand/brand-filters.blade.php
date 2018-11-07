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
                <a class="dropdown-item" href="{{ route('brand.newest', $brands->id) }}">Popularidad</a>
                <a class="dropdown-item" href="{{ route('brand.lowest', $brands->id) }}">Menor Precio</a>
                <a class="dropdown-item" href="{{ route('brand.highest', $brands->id) }}">Mayor Precio</a>
                <a class="dropdown-item" href="{{ route('brand.alpha.lowest', $brands->id) }}">Productos A-Z</a>
                <a class="dropdown-item" href="{{ route('brand.alpha.highest', $brands->id) }}">Productos Z-A</a>
            </div>
        </div>
    </form>
</div>
<div class="filters col-sm-10 col-md-10 col-lg-10">
    <form class="form-inline" action="{{route('bran.filter', $brands->id)}}" method="GET">
        <div class="form-row align-items-center">
            {{-- <div class="dropdown ajuste alineado" >
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Marcas
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check text-left" aria-labelledby="dropdownMenu1" style="background-color: #616161;">
                    @php
                        $contador = count($marcas['brand_name']);
                        $b = 'bra';
                    @endphp
                    @for ($i = 0; $i < $contador; $i++)
                        <li><label for="{{$b.$i}}"><input class="text-left" type="checkbox" name="brand[]" value="{{$marcas['id'][$i]}}, {{$marcas['brand_name'][$i]}}" id="{{$b.$i}}" /><strong class="ml-1">{{$marcas['brand_name'][$i]}}</strong></label></li>
                    @endfor
                </ul>
            </div> --}}

            <div class="dropdown ajuste alineado" >
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Por Categoria   
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check" aria-labelledby="dropdownMenu2" style="background-color: #616161;">
                    @php
                        $contador = count($categorias['category']);
                        $c = 'cat';
                    @endphp
                    @for ($i = 0; $i < $contador; $i++)
                        <li><label for="{{$c.$i}}"><input class="text-left" type="checkbox" name="categories[]" value="{{$categorias['id'][$i]}}, {{$categorias['category'][$i]}}" id="{{$c.$i}}" /><strong class="ml-1">{{$categorias['category'][$i]}}</strong></label></li>
                    @endfor
                </ul>
            </div>

            <div class="ajuste minimo">
                <input type="text" name="desde" class="form-control" placeholder="$ Mínimo" style="width: 100px;">
            </div>

            <div class="ajuste maximo">
                <input type="text" name="hasta" class="form-control ml-2" placeholder="$ Máximo" style="width: 100px;">
            </div>    

            <div class="ajuste alineado">
                <input type="hidden" name="id" value="{{$brands->id}}">
                <input type="hidden" name="fil" value="1">
                <button class="btn btn-info" type="submit"><i class="fa fa-search fa-lg" style="width: 20px;" aria-hidden="true"></i></button>
            </div> 
        </div>
    </form>
</div>
