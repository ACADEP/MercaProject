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
                <th>Nivel</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->admin}}</td>
                    <td>
                        <div class="form-inline">
                            <button class="btn btn-danger btn-xs btn-delete-category" value="" data-toggle="tooltip" value="" data-placement="top" title="Eliminar"><i class="fa fa-minus-square" aria-hidden="true"></i></button>
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
@stop


@section('modal-add-category')
<div class="modal fade" id="add_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title text-center" id="exampleModalLongTitle">Agregar usuario</h1>
      </div>
      <div class="modal-body">
      <form id="form-category" action="{{ route('add-category') }}" method="POST">
            {{csrf_field()}}
            <div class="text-right" style="margin-bottom:5px;">
                <button type="submit" class="btn btn-success">Agregar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
           
               
            <label for="user_name">Nombre de usuario:</label>
            <input type="text" name="user_name" maxLength='75' require autocomplete="off"  class="form-control" value="">
            <br>
            <label for="email_user">Correo electroníco:</label>
            <input type="email" name="email_user" maxLength='75' require autocomplete="off"  class="form-control" value="">
            <br>
            <label for="pass_user">Contraseña:</label>
            <input type="email" name="pass_user" maxLength='75' require autocomplete="off"  class="form-control" value="">
            <br>
            
            
        </form>
       
       
      </div>
    </div>
  </div>
</div>
@stop