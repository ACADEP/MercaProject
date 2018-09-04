@extends('seller.dash')

@section('content')
<section class="content-header">
        <h1>
            Actualizar producto<br>
            <small>Producto: {{$product->product_name}}</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
</section><br>
<form class="col-md-6" action="{{ route('update-Product') }}" method="POST">
            {{csrf_field()}}
            <div class="form-group col-md-12">
                <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}" placeholder="Nombre del producto">
                <br>
                <input type="text" name="product_qty" class="form-control" value="{{$product->product_qty}}" placeholder="Numero de existencia">
                <br>
                <input type="text" name="product_inv" class="form-control" value="{{$product->product_sku}}" placeholder="Numero de inventario">
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="numeric" name="product_price" value="{{$product->price}}" class="form-control" placeholder="Precio del producto">
                </div>
                <div class="form-group col-md-6">
                    <input type="numeric" name="product_reduced" value="{{$product->reduced_price}}" class="form-control" placeholder="Descuento">
                </div>
            </div>
            @php
                $categorias=App\Category::all();
                $marcas=App\Brand::all();
            @endphp
            <div class="form-row">
                <div class="form-group col-md-6">
                    <select name="categoria" id="select_cat" class="form-control">
                        <option selected>Categoria</option>
                        @foreach($categorias as $categoria)
                            <option value="{{$categoria->id}}">{{$categoria->category}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById("select_cat").value="{{ $product->category->id }}";</script>
                </div>
                <div class="form-group col-md-6">
                    <select name="marca" id="select_brand" class="form-control">
                        <option selected>Marca</option>
                        @foreach($marcas as $marca)
                            <option value="{{ $marca->id }}">{{$marca->brand_name}}</option>
                        @endforeach
                    </select>
                    <script>document.getElementById("select_brand").value="{{ $product->brand->id }}";</script>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <textarea class="form-control" name="product_des"   placeholder="Descripcion" cols="30" rows="5">{{$product->description}}</textarea>
                </div>
                <div class="form-group col-md-6">
                    <textarea class="form-control" name="product_spec"  placeholder="Especificaciones" cols="30" rows="5">{{$product->product_spec}}</textarea>
                </div>
            </div>

           
            <div class="form-group col-md-6 text-center" style="width: 100%;">
                <button type="submit" class="btn btn-success">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Volver</button>
            </div>
            
        </form>
        <div class="col-md-6">
                    @if($product->photos->count()<=0)
                        <div class="col-md-12">
                           <h2>No hay imagenes del producto</h2>
                        </div>
                    @else
                        @foreach($product->photos as $photo)
                        <form action="{{route('delete-Photo',$photo->id)}}" method="POST">
                            {{ method_field('delete') }} {{ csrf_field() }}
                            <div class="col-md-4">
                                <button class="btn btn-danger btn-xs" style="position: absolute;"><i class="fa fa-remove"></i></button>
                                <img class="img-responsive" src="{{$photo->path}}">
                            </div>
                        </form>
                        @endforeach
                    @endif
                    <div class="dropzone" style="float: left; margin-top:30px; width: 100%;">
                    <input type="hidden" name="product_id" id="product_seller_id" value="{{$product->id}}">
                    </div>
        </div>
    
@stop