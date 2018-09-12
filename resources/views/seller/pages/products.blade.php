@extends('seller.dash')

@section('content')
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
                    <td><img src="{{$productSeller->product->photos->first()->path}}" width="100%" height="30px"></td>
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
                        <button class="btn btn-default btn-xs btn-image" value="{{$productSeller->product->id}}"data-toggle="modal" data-target="#add_images" data-placement="top" title="Subir imagenes"><i class="fa fa-file-image-o" aria-hidden="true"></i></button>
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
