@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Editar roles y permisos
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

 <form action="{{ route('update-role') }}" method="post">
                {{csrf_field()}}
                <div class="text-right" style="margin-right:45px;">
                <button class="btn btn-success" type="submit">Actualizar</button>
                <a type="button" class="btn btn-default" href="{{url()->previous()}}">Regresar</a>
                </div>
        <div class="col-md-6 form-group">
        
            <h3>Role</h3>
                <input type="hidden" name="role" value='{{$role->id}}'>
                <label for="name">Identificador</label>
                <input type="text" id="name" name="name" class="form-control" disabled value="{{ $role->name }}">
                <label for="display_name">Nombre</label>
                <input type="text" id="display_name" name="display_name" class="form-control" value="{{ $role->display_name }}">
          
        </div>

            <div class="col-md-6 form-group">
                <h3>Permisos</h3>
                
                @if($permissions->count() != 0)
                @if($role->id==2)
                <span class="help-block">Este rol no se le permite permisos</span>
                @else
                @foreach($permissions as $permission)
                    <div class="col-md-4">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                        {{ $role->permissions->contains( $permission->id) 
                            || collect(old('permissions'))->contains($permission->name) 
                            ? 'checked' : '' }}>
                        {{ $permission->display_name }}
                    <br>
                    </div>
                @endforeach
                @endif
                @else
                <span class="help-block">No existen permisos</span>
                @endif
            
            </div><!-- fin del col-md-6 -->
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