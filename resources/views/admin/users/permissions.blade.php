@extends("admin.dash")

@section("content")
<section class="content-header">
        <h1>
            Permisos
        </h1> 
</section><br>
<div class="text-right"><a type="button" class="btn btn-default" href="{{url('admin/users/RolesPermissions')}}">Regresar</a></div>
<table class="table text-center">
    <thead>
            <tr>
                <th>Identificador</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr id="r-permission{{$permission->id}}">
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->display_name}}</td>
                    <td>
                        <div class="form-inline">
                            <form action="{{ route('show-editpermission', $permission) }}" method="get" style="display:inline;">
                                <button class="btn btn-info btn-xs" type="submit" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></button>
                            </form>
                            
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