
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
                                        <form action="{{ $route }}" method="GET" id="form-filter">
                                            <div class="form-group">
                                                <div class="dropdown">
                                                    <button class="btn btn-primary btn-block btn-rounded waves-effect waves-light dropdown-toggle" id="order" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        Ordenar por
                                                    </button>        
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        {{-- <button class="dropdown-item" type="submit" value="1" name="Popularidad">Popularidad</button> --}}
                                                        <button class="dropdown-item btn-order" type="button" value="Menor" name="Menor">Menor Precio</button>
                                                        <button class="dropdown-item btn-order" type="button" value="Mayor" name="Mayor">Mayor Precio</button>
                                                        <button class="dropdown-item btn-order" type="button" value="AZ" name="AZ">Productos A-Z</button>
                                                        <button class="dropdown-item btn-order" type="button" value="ZA" name="ZA">Productos Z-A</button>
                                                    </div>
                                                </div>
                                            </div>

                                           <input type="hidden" name="order" value="@if(!empty($old_inputs)){{$old_inputs->order}}@endif">

                                            <div class="form-group">
                                                <div class="dropdown" >
                                                    <button class="btn btn-primary btn-block dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        Marcas
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu1" style="overflow-y: scroll !important; height:200px;">
                                                        @foreach ($marcas as $marca)
                                                            <li><label for="{{'bra'.$marca->id}}"><input class="text-left" type="checkbox" name="brand[]" 
                                                                @if(!empty($old_inputs)) @if($old_inputs->brand!= null) @if(in_array($marca->id,$old_inputs->brand)) checked @endif @endif @endif
                                                                value="{{$marca->id}}" id="{{'bra'.$marca->id}}" /><strong class="ml-1">{{$marca->brand_name}}</strong></label></li>
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
                                                    <ul class="dropdown-menu check filter-color text-left pl-2" aria-labelledby="dropdownMenu2" style="overflow-y: scroll !important; height:200px;">
                                                        @foreach ($categorias as $categoria)
                                                            <li><label for="{{'cat'.$categoria->id}}"><input class="text-left" type="checkbox" name="categories[]" 
                                                                @if(!empty($old_inputs)) @if($old_inputs->categories!= null) @if(in_array($categoria->id,$old_inputs->categories)) checked @endif @endif @endif
                                                                value="{{$categoria->id}}" id="{{'cat'.$categoria->id}}" /><strong class="ml-1">{{$categoria->category}}</strong></label></li>
                                                        @endforeach                                    
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio Mínimo</label>
                                                <input type="number" min="0" name="desde" value="@if(!empty($old_inputs)){{$old_inputs->desde}}@endif" class="form-control" placeholder="00.00">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Precio Máximo</label>
                                                <input type="number" min="0" name="hasta" value="@if(!empty($old_inputs)){{$old_inputs->hasta}}@endif" class="form-control" placeholder="00.00">
                                            </div>
                                            <hr>
                                            @if(!empty($search_find))
                                                <input type="hidden" name="search" value="{{ $search_find }}"> 
                                            @endif               
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

@section('js')
    <script>
            $(".btn-order").click(function(){
                
                var order=$(this).val();
                
                $("#form-filter").submit(function(){
                    // Let's find the input to check
                    var $input = $(this).find("input[name=order]");
                    $input.val(order);
                   
                });

                    $("#form-filter").submit()  
                    
            });
    </script>
@endsection