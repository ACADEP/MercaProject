<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Busqueda especializada
</button> -->

<style>
    .ajuste {
      padding-left: 32px;
    }
    .alineado {
    }
    .ordenado {
    }
    .filters {
    }
</style>

    <!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Busqueda Especializada</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="filters col-sm-12 col-md-12 col-lg-12">
              <form class="form-inline" action="{{route('special.filter')}}" method="GET">
                  @php
                      $categorias=App\Category::all();
                      $marcas=App\Brand::all();
                  @endphp
                  <div class="form-row align-items-center">
                      <div class="dropdown ajuste alineado">
                          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Marcas
                              <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu check text-left" aria-labelledby="dropdownMenu1" style="background-color: #616161;">
                              @foreach ($marcas as $marca)
                                  <li><label for="{{'bra'.$marca->id}}"><input class="text-left" type="checkbox" name="brand[]" value="{{$marca->id}}, {{$marca->brand_name}}" id="{{'bra'.$marca->id}}" /><strong class="ml-1">{{$marca->brand_name}}</strong></label></li>
                              @endforeach
                          </ul>
                      </div>
          
                      <div class="dropdown ajuste alineado">
                          <button class="btn btn-info dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                              Por Categoria   
                              <span class="caret"></span>
                          </button>
                          <ul class="dropdown-menu check" aria-labelledby="dropdownMenu2" style="background-color: #616161;">
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
                          <button class="btn btn-info" type="submit"><i class="fa fa-search fa-lg" style="width: 20px;" aria-hidden="true"></i></button>
                      </div>                    
                  </div>
              </form>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        {{-- <button type="submit" class="btn btn-primary">Buscar</button> --}}
      </div>
    </div>
  </div>
</div>


