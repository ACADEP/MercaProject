@extends('seller.dash')

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
@if(Session::has('msg'))
    <div class="alert alert-success"> 
        {{ Session::get('msg') }}
    </div>
@endif
<form class="col-md-6" action="{{ route('update-Product') }}" method="POST">
            {{csrf_field()}}
            <div class="form-group col-md-12 text-right" style="width: 100%;">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a type="button" href="{{ route('my-products') }}" class="btn btn-info">Volver</a>
            </div>
            <input type="hidden" name="product_id" value="{{ $product->id }}">
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

           
           
            
        </form>
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