@extends('admin.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/seller/admin') }}">Perfil</a></li>
        <li class="breadcrumb-item active" aria-current="page">Mis Productos</li>
    </ol>
</nav>          

<section class="content-header">
        <h1>
            Mis productos
        </h1>
        
</section><br>
<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_product"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar producto</button>
</div>
<table class="text-center table col-md-12" style="width:100%;">
    <thead>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio unitario</th>
                <th>Descuento</th>
                <th>Categoria</th>
                <th>Marca</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
        @if($productsSeller!=null)
            @foreach($productsSeller as $productSeller)
            <tr id="product-seller{{$productSeller->product->id}}">
                @if($productSeller->product->photos->count()<=0)
                    <td><img src="/images/no-image-found.jpg" height="30px"></td>
                @else
                    <td><img src="{{$productSeller->product->photos->first()->path}}"  height="30px"></td>
                @endif
                <td>{{substr($productSeller->product->product_name, 0, 25)}}</td>
                
                <td>${{number_format($productSeller->product->price, 2)}}</td>
                <td>{{$productSeller->product->reduced_price}}</td>
                <td>{{$productSeller->product->category->category}}</td>
                <td>{{$productSeller->product->brand->brand_name}}</td>
               
                
                <td>
                    <div class="form-inline">
                        <button class="btn btn-danger btn-xs btn-delete" data-toggle="tooltip" value="{{$productSeller->product->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        <a type="button" href="{{ route('my-update',$productSeller->product->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                        <button class="btn btn-default btn-xs btn-image" value="{{$productSeller->product->id}}" data-toggle="modal" data-target="#add_images" data-placement="top" title="Subir imagenes"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                    </div>              
                </td>
            
            </tr>
            @endforeach
        @endif
        </tbody>
    
    </table>

@stop

@section('mostrar-modal')
@if($errors->any())
    <script>
        $(function() {
            $('#add_product').modal('show');
        });
    </script>
@endif
@if(Session::has('msg'))
<script>
        $(function() {
            $('#add_images').modal('show');
            $('#product_seller_id').val("{{$productsSeller->last()->product->id}}");
        });
</script>
@endif
@stop

@section('modal-add-products')
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
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
                                                <option value="-1" selected>Seleccionar</option>
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
                                                <option value="-1" selected>Seleccionar</option>
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
                                <label for="code_mode">Código del fabricante:</label>
                                <input type="text" name="code_mode" maxLength='10' autocomplete="off" class="form-control" value="{{old('code_mode')}}">
                                <label for="guaranty">Garantía:</label>
                                <input type="text" name="guaranty" maxLength='10' autocomplete="off" class="form-control" value="{{old('guaranty')}}">
                                
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
                                <label for="{{ $paqueteria->id }}"><input type="checkbox" name="paq[]" value="{{ $paqueteria->id }}" id="{{ $paqueteria->id }}" />{{ $paqueteria->name }}</label>
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
@stop

