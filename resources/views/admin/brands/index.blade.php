@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Marcas
        </h1> 
</section><br>
<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_category"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar marca</button>
</div>

<table class="text-center table">
        <thead>
            <tr>
                <th>Logo</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        @foreach($brands as $brand)
        <tr id="rowBrand{{$brand->id}}">
            <td class="col-md-2"><img src="{{$brand->thumbnail_path}}" style="width:30%; height:50px;"></td>
            <td>{{ $brand->brand_name}}</td>
            <td>
                <div class="form-inline">
                    <button class="btn btn-danger btn-xs btn-delete-brand" value="{{$brand->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    <form action="" method="get" style="display:inline;">
                        <button class="btn btn-info btn-xs" type="submit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                    </form>
                    
                </div>   
            </td>
            
        </tr>
        @endforeach
        </tbody>
    
    </table>
   
    

@stop