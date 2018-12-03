@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Marcas
        </h1> 
</section><br>
<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_brand"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar marca</button>
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
                    <button class="btn btn-danger btn-xs btn-row-brand" value="{{$brand->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                    <form action="{{route('showEdit-brands', $brand->id)}}" method="get" style="display:inline;">

                        <button class="btn btn-info btn-xs" type="submit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                    </form>
                    
                </div>   
            </td>
            
        </tr>
        @endforeach
        </tbody>
    
    </table>
    <div class="text-center col-md-10" style="position: absolute; bottom: 10px;">
    {{$brands->links()}}
    </div> 
   

@stop

@section('show-modal')
@if($errors->any())
    <script>
        $(function() {
            $('#add_brand').modal('show');
        });
    </script>
@endif
@stop

@section('msg-success')
@if(Session::has("success"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("success")}}</strong>' 
},{
    // settings
    type: 'success',
    delay:3000
});
</script>
@endif
@stop


@section('modal-add')
<div class="modal fade" id="add_brand" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar marca</h1>
      </div>
      <div class="modal-body row">
      @if ($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <ul><button type="button" class="close" data-dismiss="alert" aria-label="Close" ><span aria-hidden="true">&times;</span></button>
                @foreach ($errors->all() as $error)
                    <li style="list-style-type: none;">{{ $error }} </li>
                @endforeach
            
            </ul>
            
        </div>
        @endif
      <form action="{{ route('add-brands') }}" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="text-right" style="margin-right:45px;">
                <button class="btn btn-success" type="submit">Agregar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
        <div class="col-md-6 form-group">
            <label for="brand_name">Nombre de la marca</label>
            <input type="text" id="brand_name" required name="brand_name" class="form-control" value="{{ old('brand_name') }}">
        </div>
        <div class="col-md-6">
            <label for="logo">Elegir el logo</label>
            <input type="file" name="logo" required class="form-control" id="logo">
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop