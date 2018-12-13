@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Editar usuarios
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

<div class="col-md-6">
<h3>Datos personales</h3>
<form action="{{ route('update-User') }}" method="post">
    {{csrf_field()}}
    <div class="text-right">
        <button class="btn btn-success" type="submit">Actualizar</button>
        <a type="button" class="btn btn-default" href="{{url('admin/users/users')}}">Regresar</a>
    </div>

    <input type="hidden" name="user" value="{{$user->id}}">
    <label for="username">Nombre de usuario</label>
    <input type="text" id="username" name="username" class="form-control" value="{{ $user->username }}">
    <label for="email">Correo</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ $user->email }}">
    <label for="password">Contraseña</label>
    <input type="password" id="password" name="password" class="form-control">
    <label for="password_confirmed">Repite la Contraseña</label>
    <input type="password" id="password_confirmed" name="password_confirmation" class="form-control">
    <span class="help-block">Dejar en blanco si no quieres cambiar la contraseña</span>
</form>
</div>

<div class="col-md-6">
<h3>Roles y permisos</h3>
<h4>Roles</h4>
<form action="{{ route('update-RoleUser', $user) }}" method="post">
@if($roles->count() != 0)
{{csrf_field()}}
<div class="text-right">
    <button class="btn btn-success" type="submit">Actualizar roles</button>
</div>

@foreach($roles as $role)
    @if($loop->iteration!=1)
    <div class="col-md-4">
    <input type="radio" name="roles[]" value="{{ $role->name }}" 
        {{ $user->roles->contains($role->id) ? 'checked' : '' }}>
        {{ $role->display_name }}
    <small class="text-muted">{{$role->permissions->pluck('display_name')->implode(', ')}}</small>
    </div>
    @endif
@endforeach
@else
<span class="help-block">No existen roles</span>
@endif
</form>

<br><hr>

<form action="{{ route('update-Permission', $user) }}" method="post">
@if($permissions->count() != 0)
{{csrf_field()}}
<div class="col-md-12">
<h4>Permisos</h4>
<div class="text-right">
    <button class="btn btn-success" type="submit">Actualizar permisos</button>
   
</div>
</div>
@foreach($permissions as $permission)
<div class="col-md-4">
    <input type="checkbox" name="permissions[]" value="{{ $permission->name }}" 
        {{ $user->permissions->contains( $permission->id) ? 'checked' : '' }}>
        {{  $permission->display_name }}
</div>
@endforeach
@else
<span class="help-block">No existen permisos</span>
@endif
</form>


</div>

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