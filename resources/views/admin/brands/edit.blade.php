@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Editar marca
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

<form action="{{ route('edit-brands') }}" method="post" enctype="multipart/form-data">
    {{csrf_field()}}
    <input type="hidden" name="brand" value="{{$brand->id}}">
    <div class="text-right" style="margin-right:45px;">
    <button class="btn btn-success" type="submit">Actualizar</button>
    <a type="button" href="{{route('show-brands')}}" class="btn btn-default">Regresar</a>
    </div>
    <div class="col-md-6 form-group">
        <label for="brand_name">Nombre de la marca</label>
        <input type="text" id="brand_name" required name="brand_name" class="form-control" value="{{ $brand->brand_name }}">
    </div>
    <div class="col-md-6  form-group">
        <h4>Logo actual</h4>
        <img src="{{$brand->path}}" style="width:50%; height:150px;"><br>
        <label for="logo">Elegir otro logo</label>
        <input type="file" name="logo" class="form-control" id="logo">
        <span class="help-block">No subir imagen si se quiere dejar el mismo logo</span>
    </div>
</form>

@stop

@section("msg-success")
@if(Session::has('flash'))
<script> 
    $.notify({
        // options
        message: '<strong>{{ Session("flash") }}</strong>' 
    },{
        // settings
        type: 'success',
        delay:3000
    });
    </script>
@endif

@stop