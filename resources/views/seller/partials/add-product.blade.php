<div class="modal fade" id="add_product" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar producto</h1>
      </div>
      <div class="modal-body">
        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                @foreach ($errors->all() as $error)
                    <li style="list-style-type: none;">{{ $error }} </li>
                @endforeach
            
            </ul>
            
        </div>
        @endif
        <form action="{{ route('add-Product') }}" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Agregar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
            
        <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1primary" data-toggle="tab">Información del producto</a></li>
                            <li><a href="#tab2primary" data-toggle="tab">Opcional</a></li>
                            <li><a href="#tab3primary" data-toggle="tab">Paquetería</a></li>
                          
                        </ul>
                </div>
                
                <div class="panel-body">
                   
                        
                    <div class="tab-content">
                       
                            <div class="tab-pane fade in active" id="tab1primary">
                            <div class="form-group col-md-12">
                                        <label for="product_name">Nombre del producto:</label>
                                        <input type="text" name="product_name" maxLength='75' autocomplete="off" required class="form-control" value="{{old('product_name')}}">
                                        <label for="product_qty">Cantidad:</label>
                                        <input type="text" name="product_qty" maxLength='4' autocomplete="off" required class="form-control" value="{{old('product_qty')}}">
                                        <label for="product_sku">Clave sku:</label>
                                        <input type="numeric" name="product_sku" maxLength='15' autocomplete="off" required class="form-control" value="{{old('product_sku')}}" >
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="product_price">Precio:</label>
                                            <input type="numeric" name="product_price" maxLength='20' autocomplete="off" required class="form-control" value="{{old('product_price')}}">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="product_reduced">Descuento:</label>
                                            <input type="numeric" name="product_reduced" maxLength='20' autocomplete="off" required class="form-control" value="{{old('product_reduced')}}" >
                                        </div>
                                    </div>
                                    @php
                                        $categorias=App\Category::all();
                                        $marcas=App\Brand::all();
                                    @endphp
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                        <label for="select_cat">Categoría:</label>
                                            <select name="categoria" id="select_ctd" class="form-control">
                                                <option value="-1" selected>Categoria</option>
                                                @foreach($categorias as $categoria)
                                                    <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if( old('categoria')!="")
                                            <script>document.getElementById("select_ctd").value="{{ old('categoria') }}";</script>
                                        @endif
                                        <div class="form-group col-md-6">
                                        <label for="select_brand">Marca:</label>
                                            <select name="marca" id="marca_brd" class="form-control">
                                                <option value="-1" selected>Marca</option>
                                                @foreach($marcas as $marca)
                                                    <option value="{{ $marca->id }}">{{$marca->brand_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if( old('marca')!="")
                                            <script>document.getElementById("marca_brd").value="{{ old('marca') }}";</script>
                                        @endif
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="product_des">Descripción:</label>
                                            <textarea class="form-control" style="resize: none;" maxLength='250' autocomplete="off" name="product_des"  required   cols="30" rows="10">{{old('product_des')}}</textarea>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label for="product_spec">Especificaciones:</label>
                                            <textarea class="form-control" style="resize: none;" maxLength='250' autocomplete="off" name="product_spec" required    cols="30" rows="10">{{old('product_spec')}}</textarea>
                                        </div>
                                    </div>    
                            </div>
                        <div class="tab-pane fade" id="tab2primary">
                            <div class="form-group col-md-12">
                                <label for="code_mode">Codigo del fabricante:</label>
                                <input type="text" name="code_mode" maxLength='75' autocomplete="off" class="form-control" value="{{old('code_mode')}}">
                                <label for="guaranty">Garantía:</label>
                                <input type="text" name="guaranty" maxLength='4' autocomplete="off" class="form-control" value="{{old('guaranty')}}">
                                
                                <label for="prom_date">Fecha de vencimiento de promoción:</label>
                                <div class='input-group date' id='datetimepicker1'>
                                    <input type='text' name="date_prom" class="form-control" />
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                                
                            </div>
                        </div>

                        <div class="tab-pane fade form-inline" id="tab3primary">
                            @foreach($paqueterias as $paqueteria)
                                <label for="one"><input type="checkbox" name="paq[]" value="{{ $paqueteria->id }}" id="one" />{{ $paqueteria->name }}</label>
                                <input type="numeric" name="price_paq{{ $paqueteria->id }}" maxLength='15' autocomplete="off" required class="form-control" value="{{ $paqueteria->rate }}" ><br>
                            @endforeach
                        
                        </div>
                        
                        
                    </div>
                
                </div>
            

            </div>
        </form>
        
      </div>
      
    </div>
  </div>
</div>

