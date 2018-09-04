@extends('seller.dash')

@section('content')
<section class="content-header">
        <h1>
            Mis productos<br>
            <small>Lista de productos en venta</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
            <li class="active">Here</li>
        </ol>
</section><br>
<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_product"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar producto</button>
</div>
<table class="text-center table">
    <thead>
            <tr>
                <th>Producto</th>
                <th>Nombre del producto</th>
               
                <th>Precio unt</th>
                <th>Descuento</th>
                <th>Categoria</th>
                <th>Marca</th>
                <th>Descripcion</th>
               
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productsSeller as $productSeller)
            <tr>
                @if($productSeller->product->photos->count()<=0)
                    <td><img src="/images/no-image-found.jpg" width="100%" height="30px"></td>
                @else
                    <td><img src="{{$productSeller->product->photos->first()->path}}" width="100%" height="30px"></td>
                @endif
                <td>{{$productSeller->product->product_name}}</td>
                
                <td>{{$productSeller->product->price}}</td>
                <td>{{$productSeller->product->reduced_price}}</td>
                <td>{{$productSeller->product->category->category}}</td>
                <td>{{$productSeller->product->brand->brand_name}}</td>
                <td>{{$productSeller->product->description}}</td>
                
                <td>
                    <div class="form-inline">
                        <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                        <a type="button" href="{{ route('my-update',$productSeller->product->id) }}" class="btn btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Actualizar"><i class="fa fa-check-square" aria-hidden="true"></i></a>
                        <button class="btn btn-info btn-xs btn-image" value="{{$productSeller->product->id}}"data-toggle="modal" data-target="#add_images" data-placement="top" title="Subir imagenes"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
                    </div>              
                </td>
            
            </tr>
            @endforeach
        </tbody>
    
    </table>
    
    
@stop

