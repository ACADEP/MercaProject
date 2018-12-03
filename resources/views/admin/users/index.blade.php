@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Usuarios
        </h1> 
</section><br>

<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_user"><i class="fa fa-plus-square" aria-hidden="true"></i> Agregar usuario</button>
</div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr id="r-User{{$user->id}}">
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->getRoleDisplayNames()}}</td>
                    <td>
                        <div class="form-inline">
                            @if($loop->iteration!=1)
                            <button class="btn btn-danger btn-xs btn-delete-user" value="{{$user->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                            
                            <form action="{{route('show-update', $user)}}" method="get" style="display:inline;">
                                <button class="btn btn-info btn-xs" type="submit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                            </form>
                            @endif
                            
                        </div>   
                    </td>
                </tr>
            @endforeach
        </tbody>
    
    </table>
@stop

@section('show-modal')
@if($errors->any())
    <script>
        $(function() {
            $('#add_user').modal('show');
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
@if(Session::has("flash"))
<script>
 $.notify({
    // options
    message: '<strong>{{session("flash")}}</strong>' 
},{
    // settings
    type: 'success',
    delay:3000
});
</script>
@endif
@stop


@section('modal-add')
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar usuario</h1>
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
      <form action="{{ route('add-User') }}" method="post">
                {{csrf_field()}}
                <div class="text-right" style="margin-right:45px;">
                <button class="btn btn-success" type="submit">Agregar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
        <div class="col-md-6 form-group">
        
            <h3>Datos personales</h3>
                <label for="username">Nombre de usuario</label>
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}">
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" class="form-control">
                <label for="password_confirmed">Repite la Contraseña</label>
                <input type="password" id="password_confirmed" name="password_confirmation" class="form-control">
          
        </div>

            <div class="col-md-6 form-group">
                <h3>Roles y permisos</h3>
                <div class="col-md-12">
                <h4>Roles</h4>
                @if($roles->count() != 0)

                @foreach($roles as $role)
                    @if($loop->iteration!=1)
                        <div class="col-md-6">
                        <input type="radio" name="roles[]" value="{{ $role->name }}">
                            {{ $role->display_name }}
                        <small class="text-muted">{{$role->permissions->pluck('display_name')->implode(', ')}}</small>
                        </div>
                    @endif
                @endforeach
                @else
                <span class="help-block">No existen roles</span>
                @endif
                </div>

                <br><hr>
                <div class="col-md-12">
               <h4>Permisos</h4>
                @if($permissions->count() != 0)
            
                @foreach($permissions as $permission)
                    <div class="col-md-6">
                    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}">
                        {{ $permission->display_name }}
                    </div>
                @endforeach
                @else
                <span class="help-block">No existen permisos</span>
                @endif
                </div>
                
            </div><!-- fin del col-md-6 -->
        </form>
      </div>
    </div>
  </div>
</div>
@stop