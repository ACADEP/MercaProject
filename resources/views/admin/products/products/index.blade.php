@extends('admin.dash')

@section('content')

<nav aria-label="breadcrumb" style="padding-top: 5px;">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
        <li class="breadcrumb-item"><a href="{{ url('/admin/index') }}">Perfil</a></li>
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
        @foreach($products as $product)
        <tr id="rowProduct{{$product->id}}">
                @if($product->photos->count()<=0)
                    <td><img src="/images/no-image-found.jpg" height="30px"></td>
                @else
                    <td class="col-md-2"><img src="{{$product->photos()->first()->path}}" style="width:30%; height:50px;"></td>
                @endif
           
            <td class="col-md-2">{{ $product->product_name }}</td>
            <td>${{ number_format($product->price, 2) }}</td>
            <td class="col-md-2">%{{ substr($product->reduced_price*100/$product->price, 0,5) }}</td>
            <td>{{ $product->category->category }}</td>
            <td>{{ $product->brand->brand_name }}</td>
            <td>
                <div class="form-inline">
                    <button class="btn btn-danger btn-xs btn-delete-product" data-toggle="tooltip" value="{{$product->id}}" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    <a type="button" href="{{route('show-edit', $product)}}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a>
                    <button class="btn btn-default btn-xs btn-image" value="{{$product->id}}" data-toggle="modal" data-target="#add_images" data-placement="top" title="Subir imagenes"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                </div>    
            </td>
        </tr>
        @endforeach
        </tbody>
    
    </table>

    <div class="text-center col-md-10" style="position: absolute; bottom: 10px;">
    {{$products->links()}}
    </div> 

@stop

@section('show-modal')
@if($errors->any())
    <script>
        $(function() {
            $('#add_product').modal('show');
        });
    </script>
@endif
@if(Session::has('product_added'))
<script>
        $(function() {
            $('#add_images').modal('show');
            $('#product_seller_id').val("{{$products->last()->id}}");
           
        });
</script>
@endif
@stop

@section('modal-add')
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
                            <li><a href="#tab3primary" data-toggle="tab">Dimenciones</a></li>
                          
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

                        <div class="tab-pane fade " id="tab3primary">
                        <div class="form-group col-md-12">
                                <label for="weight">Peso:</label>
                                <input type="text" id="weight" name="weight" maxLength='10' autocomplete="off" class="form-control" value="{{old('weight')}}">
                                <label for="height">Altura:</label>
                                <input type="text" id="height" name="height" maxLength='10' autocomplete="off" class="form-control" value="{{old('height')}}">
                                <label for="width">Anchura:</label>
                                <input type="text" id="width" name="width" maxLength='10' autocomplete="off" class="form-control" value="{{old('width')}}">
                                <label for="length">Longitud:</label>
                                <input type="text" id="length" name="length" maxLength='10' autocomplete="off" class="form-control" value="{{old('length')}}">
                                
                                
                            </div>
                        
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

@section('add-images')

<div class="modal fade" id="add_images" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar imagenes</h1>
      </div>
      <div class="modal-body">

            <div class="form-group col-md-12">
                <input type="hidden" name="product_id" id="product_seller_id">
                <div class="dropzone"></div>
            </div>
      </div>
      <div class="text-center">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
       
      </div>
      <br>
    </div>
  </div>
</div>


    <script>
        var product_id;
        $(".btn-image").click(function(){
            product_id=$(this).val();
            $("#product_seller_id").val(product_id);
           
            
        });

         var varDrop = new Dropzone('.dropzone',{
            url: "/admin/products/products/addphoto",
            acceptedFiles: 'image/*',
            maxFileSize: 2,
            maxFiles: 5,
            paramName: 'photoProducto',
            headers:{
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            dictDefaultMessage: 'Arrastra las imagenes del producto o seleccionalas (max:5)'
            });
            Dropzone.autoDiscover=false;
            
            varDrop.on('error', function(file, res){
                $('.dz-error-message:last > span').text(res.errors.photoProducto[0]);
            });
            varDrop.on('success', function(file, res){
                if(res.imageUrl!=null && res.url!=null)
                {
                    $("#images-products").append(
                    "<form action='"+res.url+"' method='POST'>"+
                    "<input type='hidden' name='_token' value='{{ csrf_token() }}'>"+
                    "<input type='hidden' name='_method' value='delete'>"+
                    "<div class='col-md-4'>"+ 
                    "<button class='btn btn-danger btn-xs' style='position: absolute;'><i class='fa fa-remove'></i></button>"+
                    "<img class='img-responsive' src='"+res.imageUrl+"'>"+
                    "</div>"+
                    "</form>"

                    );
                }
                else
                {
                    alert("Ya hay un maximo de 5 imagenes de este producto");
                }
                
            });
            varDrop.on("sending", function(file, xhr, formData, gid) {
                formData.append("product_id", $('#product_seller_id').val());
                
            });
       
        
    </script>


@stop