@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Roles y permisos
        </h1> 
</section><br>

<div class="text-right">
    <button class="btn btn-success"  data-toggle="modal" data-target="#add_role"><i class="fa fa-plus-square" aria-hidden="true"></i> Crear role</button>
    <a type="button" href="{{route('show-permissions')}}" class="btn btn-success"><i class="fa fa-eye" aria-hidden="true"></i> Ver y editar permisos</a type="button" href="{{route('show-permissions')}}">
</div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>
                <th>Permisos</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr id="r-role{{$role->id}}">
                    <td class="col-md-3">{{ $role->name }}</td>
                    <td class="col-md-3">{{$role->display_name}}</td>
                    <td class="col-md-3">
                        @if($loop->iteration==1)
                        Todos
                        @elseif($loop->iteration==2)
                        No permitidos
                        @else
                        {{$role->permissions->pluck('display_name')->implode(', ')}}
                        @endif
                    </td>
                    <td class="col-md-3">
                        <div class="form-inline">
                            @if($loop->iteration!=1)
                            <button class="btn btn-danger btn-xs btn-delete-role" value="{{$role->id}}" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
                           
                            <form action="{{ route('show-editRole', $role) }}" method="get" style="display:inline;">
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
            $('#add_role').modal('show');
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


@section('modal-add-category')
<div class="modal fade" id="add_role" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Crear rol</h1>
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
      <form action="{{ route('add-role') }}" method="post">
                {{csrf_field()}}
                <div class="text-right" style="margin-right:45px;">
                <button class="btn btn-success" type="submit">Crear rol</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
        <div class="col-md-6 form-group">
        
            <h3>Rol</h3>
                <label for="name">Identificador</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}">
                <label for="display_name">Nombre</label>
                <input type="text" id="display_name" name="display_name" class="form-control" value="{{ old('display_name') }}">
          
        </div>

            <div class="col-md-6 form-group">
              <div class="text-left"><h3>Permisos</h3></div>  
                
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
            
            </div><!-- fin del col-md-6 -->
        </form>
      </div>
    </div>
  </div>
</div>
@stop