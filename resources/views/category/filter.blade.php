<style>
/* .listings {
    width: 100%; */
}
</style>
<section class="listings">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="card bg-light">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 mb-2">
                                        <h3>Buscar</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="{{route('orderCategory',$products->first()->category)}}" method="GET">
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-block btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        {{ $ordenamiento }}
                                                    </button>        
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <button class="dropdown-item" type="submit" value="1" name="Menor">Menor Precio</button>
                                                        <button class="dropdown-item" type="submit" value="2" name="Mayor">Mayor Precio</button>
                                                        <button class="dropdown-item" type="submit" value="3" name="AZ">Productos A-Z</button>
                                                        <button class="dropdown-item" type="submit" value="4" name="ZA">Productos Z-A</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{route('category.filter', $products->first()->category->id)}}" method="GET">
                                            <div class="form-group">
                                                <div class="dropdown" >
                                                    <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Marcas
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu1">
                                                        @php
                                                            $contador = count($marcas['brand_name']);
                                                            $b = 'bra';
                                                        @endphp
                                                        @for ($i = 0; $i < $contador; $i++)
                                                            <li><label for="{{$b.$i}}"><input class="" type="checkbox" name="brand[]" value="{{$marcas['id'][$i]}}, {{$marcas['brand_name'][$i]}}" id="{{$b.$i}}" /><strong class="ml-1">{{$marcas['brand_name'][$i]}}</strong></label></li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div>
                                            {{-- <div class="form-group">
                                                <div class="dropdown" >
                                                    <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Categorias  
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu2">
                                                        @php
                                                            $contador = count($categorias['category']);
                                                            $c = 'cat';
                                                        @endphp
                                                        @for ($i = 0; $i < $contador; $i++)
                                                            <li><label for="{{$c.$i}}"><input class="" type="checkbox" name="categories[]" value="{{$categorias['id'][$i]}}, {{$categorias['category'][$i]}}" id="{{$c.$i}}" /><strong class="ml-1">{{$categorias['category'][$i]}}</strong></label></li>
                                                        @endfor
                                                    </ul>
                                                </div>
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="">Precio Mínimo</label>
                                                <input type="text" name="desde" class="form-control" placeholder="00.00">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio Máximo</label>
                                                <input type="text" name="hasta" class="form-control" placeholder="00.00">
                                            </div>
                                            <hr>
                                            <input type="hidden" name="catid" value="{{$products->first()->category->id}}">
                                            <input type="hidden" name="fil" value="1">  
                                            <button type="submit" class="btn btn-primary btn-block">Buscar</button>
                                            <button type="btn" class="btn btn-primary btn-block" name="clear" value="clear">Limpiar filtros</button>
                                            <div class="pb-3"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>