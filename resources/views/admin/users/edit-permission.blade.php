@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Editar permiso
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

 <form action="{{ route('update-permission') }}" method="post">
                {{csrf_field()}}
        <div class="col-md-6 form-group">
            <div class="text-right" >
                <button class="btn btn-success" type="submit">Actualizar</button>
                <a type="button" class="btn btn-default" href="{{url()->previous()}}">Regresar</a>
                </div>
                <input type="hidden" name="permission" value='{{$permission->id}}'>
                <label for="name">Identificador</label>
                <input type="text" id="name" name="name" class="form-control" disabled value="{{ $permission->name }}">
                <label for="display_name">Nombre</label>
                <input type="text" id="display_name" name="display_name" class="form-control" value="{{ $permission->display_name }}">
          
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