@extends('admin.dash')

@section('content')
<section class="content-header">
        <h1>
            Actualizar producto<br>
            <small>Producto: {{$product->product_name}}</small>
        </h1>
        
</section><br>
@if ($errors->any())
    <div class="alert alert-danger alert-dismissible" role="alert">
        <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
            @foreach ($errors->all() as $error)
                <li style="list-style-type: none;">{{ $error }} </li>
            @endforeach
           
        </ul>
        
    </div>
@endif
@if(Session::has('msg-success'))
    <div class="alert alert-success"> 
        {{ Session::get('msg-success') }}
    </div>
@endif
<div class="col-md-6">
<form  action="{{ route('update-Product') }}" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a type="button" href="{{ route('show-products') }}" class="btn btn-default">Volver</a>
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">

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
                        <input type="text" maxLength='75' required name="product_name" autocomplete="off" id="product_name" class="form-control" value="{{$product->product_name}}" placeholder="Nombre del producto">
                        <br>
                        <label for="product_qty">Cantidad:</label>
                        <input type="numeric" maxLength='4' required name="product_qty" autocomplete="off" id="product_qty" class="form-control" value="{{$product->product_qty}}" placeholder="Numero de existencia">
                        <br>
                        <label for="product_inv">Codigo sku:</label>
                        <input type="text" maxLength='15' required name="product_sku" autocomplete="off"  id="product_inv" class="form-control" value="{{$product->product_sku}}" placeholder="Numero de inventario">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_price">Precio:</label>
                            <input type="numeric" name="product_price" autocomplete="off" required maxLength='20' value="{{$product->price}}"  id="product_price" class="form-control" placeholder="Precio del producto">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_reduced">Descuento:</label>
                            <input type="numeric" name="product_reduced" autocomplete="off" required maxLength='20' value="{{$product->reduced_price}}" id="product_reduced" class="form-control" placeholder="Descuento">
                        </div>
                    </div>
                    @php
                        $categorias=App\Category::all();
                        $marcas=App\Brand::all();
                    @endphp
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="select_cat">Categoría:</label>
                            <select name="categoria" id="select_cat" class="form-control">
                                <option value="-1" selected>Categoria</option>
                                @foreach($categorias as $categoria)
                                    <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                                @endforeach
                            </select>
                            <script>document.getElementById("select_cat").value="{{ $product->category->id }}";</script>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="select_brand">Marca:</label>
                            <select name="marca" id="select_brand" class="form-control">
                                <option value="-1" selected>Marca</option>
                                @foreach($marcas as $marca)
                                    <option value="{{ $marca->id }}">{{$marca->brand_name}}</option>
                                @endforeach
                            </select>
                            <script>document.getElementById("select_brand").value="{{ $product->brand->id }}";</script>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="product_des">Descripción:</label>
                            <textarea class="form-control" maxLength='250' style="resize: none;" autocomplete="off"  required name="product_des"   placeholder="Descripcion" cols="30" rows="5">{{$product->description}}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="product_spec">Especificaciones:</label>
                            <textarea class="form-control" maxLength='250' style="resize: none;" autocomplete="off" required name="product_spec"  placeholder="Especificaciones" cols="30" rows="5">{{$product->product_spec}}</textarea>
                        </div>
                    </div>
            <!--tab1--></div> 
                        <div class="tab-pane fade" id="tab2primary">
                        <div class="form-group col-md-12">
                                <label for="code_mode">Código del fabricante:</label>
                                <input type="text" name="code_mode" maxLength='10' autocomplete="off" class="form-control" value="{{$product->product_manufacturer}}">
                                <label for="guaranty">Garantía:</label>
                                <input type="text" name="guaranty" maxLength='10' autocomplete="off" class="form-control" value="{{ $product->guaranty }}">
                                
                                <label for="prom_date">Fecha de vencimiento de promoción:</label>
                                <div class='input-group date' id='datetimepicker1'>
                                @php $time = strtotime($product->date_prom); $myFormatForView = date("m/d/y g:i A", $time);@endphp
                                    <input type='text' name="date_prom" value="{{ $myFormatForView }}" class="form-control" />
                                        <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                </div>
                                
                            </div>
            <!--tab2--></div> 
                        <div class="tab-pane fade" id="tab3primary">
                        <label for="weight">Peso:</label>
                                <input type="text" id="weight" name="weight" maxLength='10' autocomplete="off" class="form-control" value="{{$product->weight}}">
                                <label for="height">Altura:</label>
                                <input type="text" id="height" name="height" maxLength='10' autocomplete="off" class="form-control" value="{{$product->height}}">
                                <label for="width">Anchura:</label>
                                <input type="text" id="width" name="width" maxLength='10' autocomplete="off" class="form-control" value="{{$product->width}}">
                                <label for="length">Longitud:</label>
                                <input type="text" id="length" name="length" maxLength='10' autocomplete="off" class="form-control" value="{{$product->length}}">
                           
                            
            <!--tab3--></div> 
<!--content--></div>
 <!-- panel-body --></div>
 <!-- panel--></div>       
</form>
<!-- col-md-6 --></div>
<div class="col-md-6">
    @if($product->photos->count()<=0)
        <div class="col-md-12">
            <h2>No hay imagenes del producto</h2>
        </div>
    @else
    <div id="images-products">
        @foreach($product->photos as $photo)
            <form action="{{route('delete-Photo',$photo->id)}}"  method="POST">
                {{ method_field('delete') }} {{ csrf_field() }}
                <div class="col-md-4">
                    <button class="btn btn-danger btn-xs" style="position: absolute;"><i class="fa fa-remove"></i></button>
                    <img class="img-responsive" src="{{$photo->path}}">
                </div>
            </form>
        
        @endforeach
    </div>
    @endif
    <div class="dropzone" style="float: left; margin-top:30px; width: 100%;">
    <input type="hidden" name="product_id" id="product_seller_id" value="{{$product->id}}">
    </div>
</div>

 

@stop

@section('js-dropzone')
    <script>
        

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