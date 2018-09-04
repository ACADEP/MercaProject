<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar producto</h1>
      </div>
      <div class="modal-body">
        <form action="{{ route('add-Product') }}" method="POST">
            {{csrf_field()}}
            <div class="form-group col-md-12">
                <input type="text" name="product_name" class="form-control" placeholder="Nombre del producto">
                <br>
                <input type="text" name="product_qty" class="form-control" placeholder="Numero de existencia">
                <br>
                <input type="text" name="product_inv" class="form-control" placeholder="Numero de inventario">
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="numeric" name="product_price" class="form-control" placeholder="Precio del producto">
                </div>
                <div class="form-group col-md-6">
                    <input type="numeric" name="product_reduced" class="form-control" placeholder="Descuento">
                </div>
            </div>
            @php
                $categorias=App\Category::all();
                $marcas=App\Brand::all();
            @endphp
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select name="categoria" class="form-control">
                        <option selected>Categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <select name="marca" class="form-control">
                        <option selected>Marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{$marca->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <textarea class="form-control" name="product_des" placeholder="Descripcion" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <textarea class="form-control" name="product_spec" placeholder="Especificaciones" cols="30" rows="10"></textarea>
                </div>
            </div>
            
            <div class="text-center">
                <button type="submit" class="btn btn-success">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            
        </form>
      </div>
      
    </div>
  </div>
</div>

