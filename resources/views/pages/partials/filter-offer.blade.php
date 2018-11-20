
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
                                        <form action="{{route('offer.filter')}}" method="GET">
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-block btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown" >
                                                    <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Marcas
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu1">
                                                        @foreach ($marcas as $marca)
                                                            <li><label for="{{'bra'.$marca->id}}"><input class="text-left" type="checkbox" name="brand[]" value="{{$marca->id}}, {{$marca->brand_name}}" id="{{'bra'.$marca->id}}" /><strong class="ml-1">{{$marca->brand_name}}</strong></label></li>
                                                        @endforeach                                    
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="dropdown" >
                                                    <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Categorias  
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu2">
                                                        @foreach ($categorias as $categoria)
                                                            <li><label for="{{'cat'.$categoria->id}}"><input class="text-left" type="checkbox" name="categories[]" value="{{$categoria->id}}, {{$categoria->category}}" id="{{'cat'.$categoria->id}}" /><strong class="ml-1">{{$categoria->category}}</strong></label></li>
                                                        @endforeach                                    
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio Mínimo</label>
                                                <input type="text" name="desde" class="form-control" placeholder="00.00">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio Máximo</label>
                                                <input type="text" name="hasta" class="form-control" placeholder="00.00">
                                            </div>
                                            <hr>
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