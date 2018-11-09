<style>
.ajuste {
    float: left;
}
.alineado {
    padding-top: 2em;
}
</style>
<div class="col-sm-2 col-md-2 col-lg-2" >
    <div class="alineado">
        <form action="/pricelow" method="post">
            {{csrf_field()}}
            <div class="dropdown">
                <button class="btn btn-default btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ $ordenamiento }}
                    <!--Ordenar por -->
                </button>        
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a href="{{ route('brand.newest', $orden->id) }}">Mas nuevos</a></li>
                    <li><a href="{{ route('brand.lowest', $orden->id) }}">Precio mas bajo</a></li>
                    <li><a href="{{ route('brand.highest', $orden->id) }}">Precio mas alto</a></li>
                    <li><a href="{{ route('brand.alpha.lowest', $orden->id) }}">Productos A-Z</a></li>
                    <li><a href="{{ route('brand.alpha.highest', $orden->id) }}">Productos Z-A</a></li>            
                </div>
            </div>
        </form>
    </div>
</div>
<div class="col-sm-10 col-md-10 col-lg-10 pr-5">
    <form action="{{url('bran/filter')}}" method="POST">
        {{csrf_field()}}
        <div class="col-sm-3 col-md-3 col-lg-3 ajuste alineado">
            <div class="dropdown " style="display: inline;">
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
        </div>

        <div class="col-sm-3 col-md-3 col-lg-3 ajuste alineado">
            <div class="dropdown " style="display: inline;">
                <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    Categorias   
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
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2 ajuste">
            <label for="desde">Desde</label>
            <input type="text" name="desde" class="form-control" placeholder="$ Mínimo">
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2 ajuste">
            <label for="hasta">Hasta</label>
            <input type="text" name="hasta" class="form-control" placeholder="$ Máximo">
        </div>

        <div class="col-sm-2 col-md-2 col-lg-2 ajuste alineado">
            <input type="hidden" name="id" value="{{$banner->id}}">
            <button class="btn btn-info" type="submit">Buscar</button>
        </div>
    </form>
</div>