<style>
/* .ajuste {
    float: left;
}
.alineado {
    padding-top: 2em;
} */
</style>
<div class="alineado col-sm-2 col-md-2 col-lg-2" >
    {{-- <div class="alineado"> --}}
        <form action="/pricelow" method="post">
            {{csrf_field()}}
            <div class="dropdown">
                <button class="btn btn-default btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $ordenamiento }}
                    <!--Ordenar por -->
                </button>        
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('shop.newest', $banner->id) }}">Popularidad</a>
                    <a class="dropdown-item" href="{{ route('shop.lowest', $banner->id) }}">Menor Precio</a>
                    <a class="dropdown-item" href="{{ route('shop.highest', $banner->id) }}">Mayor Precio</a>
                    <a class="dropdown-item" href="{{ route('shop.alpha.lowest', $banner->id) }}">Productos A-Z</a>
                    <a class="dropdown-item" href="{{ route('shop.alpha.highest', $banner->id) }}">Productos Z-A</a>
                </div>
            </div>
        </form>
    {{-- </div> --}}
</div>
<div class="col-sm-10 col-md-10 col-lg-10 pr-5">
    <form class="form-inline" action="{{route('shop.filter', $banner->id)}}" method="GET">
        {{-- <div class="col-sm-3 col-md-3 col-lg-3 ajuste alineado"> --}}
            <div class="dropdown ajuste alineado">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Marcas
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu check" aria-labelledby="dropdownMenu1" style="background-color: #616161;">
                    @php
                        $contador = count($marcas['brand_name']);
                        $b = 'bra';
                    @endphp
                    @for ($i = 0; $i < $contador; $i++)
                        <li><label for="{{$b.$i}}"><input class="ml-2" type="checkbox" name="brand[]" value="{{$marcas['id'][$i]}}" id="{{$b.$i}}" /><strong class="ml-1">{{$marcas['brand_name'][$i]}}</strong></label></li>
                    @endfor
                </ul>
            </div>
        {{-- </div> --}}

        {{-- <div class="col-sm-3 col-md-3 col-lg-3 ajuste alineado"> --}}
            <div class="dropdown ajuste alineado">
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
                        <li><label for="{{$c.$i}}"><input class="ml-2" type="checkbox" name="categories[]" value="{{$categorias['id'][$i]}}" id="{{$c.$i}}" /><strong class="ml-1">{{$categorias['category'][$i]}}</strong></label></li>
                    @endfor
                </ul>
            </div>
        {{-- </div> --}}

        <div class="col-2 col-sm-2 col-md-2 ajuste">
            <input type="text" name="desde" class="form-control" placeholder="$ Mínimo">
            <input type="text" name="hasta" class="form-control" placeholder="$ Máximo">
        </div>

        <div class="col-2 col-sm-2 col-md-2 ajuste alineado">
            <input type="hidden" name="id" value="{{$banner->id}}">
            <button class="btn btn-info" type="submit">Buscar</button>
        </div>
    </form>
</div>